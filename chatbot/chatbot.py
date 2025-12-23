import re
import json
from langchain_community.embeddings import HuggingFaceEmbeddings
from langchain_community.vectorstores import Chroma
from faq import check_faq

DB_PATH = "chroma_db"

embeddings = HuggingFaceEmbeddings(
    model_name="sentence-transformers/all-MiniLM-L6-v2"
)

vectordb = Chroma(
    persist_directory=DB_PATH,
    embedding_function=embeddings
)
# =========================
# CONTEXT MAP (PROMAX++)
# =========================
#Mapping ngữ cảnh sang từ khoá
CONTEXT_KEYWORDS = {

    # THEO MÙA
    "winter": ["áo nỉ", "áo len", "áo khoác", "áo phao", "hoodie", "quần dài"],
    "summer": ["áo thun", "quần short", "váy", "đầm", "áo ba lỗ"],
    "autumn": ["áo khoác mỏng", "cardigan", "áo dài tay", "quần kaki"],
    "spring": ["áo sơ mi", "áo thun dài tay", "quần jeans", "áo khoác nhẹ"],

    # HOÀN CẢNH
    "work": ["áo sơ mi", "quần tây", "chân váy", "đầm công sở", "vest"],
    "home": ["bộ mặc nhà", "đồ ngủ", "quần thun", "áo thun"],
    "casual": ["áo thun", "quần jeans", "hoodie"],
    "party": ["đầm dự tiệc", "váy dạ hội", "áo kiểu"],
    "sport": ["đồ thể thao", "áo thể thao", "giày thể thao"],
    "travel": ["áo thun", "quần jeans", "áo khoác nhẹ"],
    "school": ["áo sơ mi", "quần dài", "giày thể thao"],
    "date": ["váy", "đầm", "áo sơ mi", "áo kiểu"]
}

INTENT_MAP = {
    "winter": ["mùa đông", "lạnh"],
    "summer": ["mùa hè", "nóng"],
    "autumn": ["mùa thu"],
    "spring": ["mùa xuân"],

    "work": ["đi làm", "công sở", "văn phòng"],
    "home": ["ở nhà", "mặc nhà"],
    "casual": ["đi chơi", "dạo phố"],
    "party": ["đi tiệc"],
    "sport": ["thể thao", "gym"],
    "travel": ["du lịch"],
    "school": ["đi học"],
    "date": ["hẹn hò"]
}

def detect_context(query: str):
    q = query.lower()
    for ctx, keywords in INTENT_MAP.items():
        if any(k in q for k in keywords):
            return ctx
    return None


def build_semantic_query(original_query, parsed):
    context = detect_context(original_query)
    keywords = []

    if context and context in CONTEXT_KEYWORDS:
        keywords.extend(CONTEXT_KEYWORDS[context])

    if parsed.get("target"):
        keywords = [f"{k} {parsed['target']}" for k in keywords]

    return ", ".join(keywords) if keywords else original_query

# =========================
# Parse nhu cầu
# =========================
def parse_query(query: str):
    q = query.lower()

    # Giá
    price_max = None
    m = re.search(r'dưới\s*(\d+)', q)
    if m:
        price_max = int(m.group(1)) * 1000

    # Giới tính (category)
    target = None
    if "nam" in q:
        target = "Nam"
    elif "nữ" in q:
        target = "Nữ"
    elif "trẻ em" in q or "bé" in q:
        target = "Trẻ em"

    # Mùa
    season = None
    if "đông" in q:
        season = "winter"
    elif "hè" in q:
        season = "summer"

    return {
        "price_max": price_max,
        "target": target,
        "season": season
    }

# =========================
# Outfit theo mùa
# =========================
def outfit_suggestion(season, target):
    if season == "winter":
        return {
            "title": f"Outfit mùa đông cho {target or 'bạn'} ❄️",
            "items": [
                "Áo len / áo nỉ dài tay",
                "Quần dài",
                "Áo khoác bông / hoodie"
            ]
        }
    if season == "summer":
        return {
            "title": f"Outfit mùa hè cho {target or 'bạn'} ☀️",
            "items": [
                "Áo thun",
                "Quần short / quần mỏng",
                "Giày thể thao / sandal"
            ]
        }
    return None

# =========================
# Chat chính
# =========================
def fashion_chat(query: str):
    # FAQ
    faq = check_faq(query)
    if faq:
        return {"answer": faq, "products": [], "outfit": None}

    parsed = parse_query(query)

    semantic_query = build_semantic_query(query, parsed)
    docs = vectordb.similarity_search(semantic_query, k=8)

    if not docs:
        return {
            "answer": "Mình chưa tìm được sản phẩm phù hợp 😥",
            "products": [],
            "outfit": None
        }

    products = []
    for d in docs:
        m = d.metadata

        # Lọc đối tượng
        if parsed["target"] and parsed["target"] != m.get("category"):
            continue

        # Lọc giá
        try:
            price = int(str(m.get("price")).replace(".", ""))
            if parsed["price_max"] and price > parsed["price_max"]:
                continue
        except:
            pass

        products.append({
            "id": m.get("id"),
            "name": m.get("name"),
            "section": m.get("section"),
            "category": m.get("category"),
            "price": m.get("price"),
            "color": m.get("color"),
            "size": m.get("size"),
            "description": m.get("description")
        })

    # Fallback nếu lọc quá tay
    if not products:
        products = [{
            "id": d.metadata.get("id"),
            "name": d.metadata.get("name"),
            "price": d.metadata.get("price"),
            "category": d.metadata.get("category")
        } for d in docs[:3]]

    outfit = outfit_suggestion(parsed["season"], parsed["target"])

    answer = "Mình gợi ý cho bạn một số sản phẩm phù hợp để tham khảo 👕👗"
    if outfit:
        answer += f"\nNgoài ra, mình đề xuất **{outfit['title']}**."

    return {
        "answer": answer,
        "products": products[:3],
        "outfit": outfit
    }
