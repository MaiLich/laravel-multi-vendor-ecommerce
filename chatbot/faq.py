FAQS = {
    "ship": {
        "keywords": ["ship", "giao hàng", "vận chuyển"],
        "answer": "Shop hỗ trợ giao hàng toàn quốc, thời gian từ 2–5 ngày tuỳ khu vực 🚚"
    },
    "return": {
        "keywords": ["đổi", "trả", "hoàn tiền"],
        "answer": "Shop hỗ trợ đổi/trả trong vòng 7 ngày nếu sản phẩm còn nguyên tem mác 🔁"
    },
    "size": {
        "keywords": ["size", "kích thước"],
        "answer": "Shop có đầy đủ size S, M, L, XL. Bạn cho mình biết chiều cao & cân nặng để tư vấn chính xác hơn nhé 📏"
    },
    "payment": {
        "keywords": ["thanh toán", "trả tiền", "cod"],
        "answer": "Shop hỗ trợ COD, chuyển khoản và ví điện tử 💳"
    }
}

def check_faq(query: str):
    q = query.lower()
    for f in FAQS.values():
        if any(k in q for k in f["keywords"]):
            return f["answer"]
    return None
