import pandas as pd
import json

DATA_PATH = "products.csv"
DB_PATH = "chroma_db"

print("🔹 Đang đọc dữ liệu sản phẩm...")
df = pd.read_csv(DATA_PATH)

# Fix description NULL
df["description"] = df["description"].fillna("")

# Parse size JSON string → text
def parse_size(val):
    try:
        return ", ".join(json.loads(val))
    except:
        return ""

df["size_text"] = df["size"].apply(parse_size)

# Build text cho embedding (RẤT QUAN TRỌNG)
def build_text(row):
    return f"""
Tên sản phẩm: {row['name']}
Nhóm sản phẩm: {row['section']}
Đối tượng: {row['category']}
Giá: {row['price']} VND
Màu sắc: {row['color']}
Kích thước: {row['size_text']}
Mô tả: {row['description']}
""".strip()

texts = df.apply(build_text, axis=1).tolist()
metadatas = df.to_dict(orient="records")

print(f"✅ Tổng số sản phẩm: {len(texts)}")

from langchain_community.embeddings import HuggingFaceEmbeddings
from langchain_community.vectorstores import Chroma

print("🔹 Load embedding (CPU)...")
embeddings = HuggingFaceEmbeddings(
    model_name="sentence-transformers/all-MiniLM-L6-v2"
)

print("🔹 Tạo Chroma DB...")
vectordb = Chroma.from_texts(
    texts=texts,
    embedding=embeddings,
    metadatas=metadatas,
    persist_directory=DB_PATH
)

vectordb.persist()
print("🎉 HOÀN TẤT DB")
