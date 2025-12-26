document.addEventListener("DOMContentLoaded", function () {
  function el(id) { return document.getElementById(id); }

  const messagesBox = el("chatbot-messages");
  const input = el("chatbot-input");
  const sendBtn = el("chatbot-send");

  // Debug: nếu không tìm thấy element thì báo luôn
  if (!messagesBox || !input || !sendBtn) {
    console.error("Chatbot DOM not found:", { messagesBox, input, sendBtn });
    return;
  }

  function appendMessage(role, text) {
    const wrap = document.createElement("div");
    wrap.className = "mb-2";

    const badge = document.createElement("span");
    badge.className = role === "user" ? "badge bg-secondary" : "badge bg-success";
    badge.textContent = role === "user" ? "Bạn" : "Bot";

    const msg = document.createElement("div");
    msg.className = "mt-1";
    msg.innerText = text;

    wrap.appendChild(badge);
    wrap.appendChild(msg);
    messagesBox.appendChild(wrap);
    messagesBox.scrollTop = messagesBox.scrollHeight;
  }

  function renderProducts(products) {
    if (!products || !Array.isArray(products) || products.length === 0) return;

    const title = document.createElement("div");
    title.className = "mt-3 fw-bold";
    title.innerText = "Gợi ý sản phẩm:";
    messagesBox.appendChild(title);

    const list = document.createElement("ul");
    list.className = "mt-2";

    products.slice(0, 8).forEach(p => {
      const li = document.createElement("li");
      const price = typeof p.price === "number" ? p.price.toLocaleString("vi-VN") : (p.price ?? "");
      li.innerText = `${p.name ?? ""} • ${price}đ • ${p.color ?? ""}`;
      list.appendChild(li);
    });

    messagesBox.appendChild(list);
    messagesBox.scrollTop = messagesBox.scrollHeight;
  }

  async function sendMessage() {
    const text = input.value.trim();
    if (!text) return;

    appendMessage("user", text);
    input.value = "";
    sendBtn.disabled = true;

    try {
      const base = window.CHATBOT_BASE_URL || "http://127.0.0.1:8001";
      console.log("Sending to:", `${base}/chat`, "message:", text);

      const res = await fetch(`${base}/chat`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ message: text })
      });

      if (!res.ok) {
        const t = await res.text();
        appendMessage("bot", `Lỗi API (${res.status}): ${t}`);
        return;
      }

      const data = await res.json();
      appendMessage("bot", data.answer ?? "(Không có answer)");
      renderProducts(data.products);

    } catch (e) {
      appendMessage("bot", `Không gọi được API: ${e.message}`);
      console.error(e);
    } finally {
      sendBtn.disabled = false;
    }
  }

  sendBtn.addEventListener("click", sendMessage);
  input.addEventListener("keydown", (e) => {
    if (e.key === "Enter") sendMessage();
  });

  console.log("Chatbot JS ready ✅");
});
