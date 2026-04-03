# https://developers.cloudflare.com/pages/

mkdir cloudflare-test && cd cloudflare-test
# Khởi tạo project Cloudflare Worker (chọn Hello World script, No TypeScript cho nhanh)
npm create cloudflare@latest .

🎉  SUCCESS  Application created successfully!

💻 Continue Developing
Deploy: npm run deploy

📖 Explore Documentation
https://developers.cloudflare.com/workers

🐛 Report an Issue
https://github.com/cloudflare/workers-sdk/issues/new/choose

💬 Join our Community
https://discord.cloudflare.com
────────────────────────────────────────────────────────────

> npx wrangler dev --local

> npx wrangler deploy

> npx wrangler tail

> npx wrangler pages dev ./public

1. Phân biệt "Hai thế giới" của CloudflareĐặc điểmWorker Mode (Hiện tại của bạn)Pages Mode (Cái bạn đang muốn thử)Cấu hìnhCó dòng "main": "src/index.js"KHÔNG có dòng main.Cách chạynpx wrangler devnpx wrangler pages dev ./publicRoutingBạn tự viết switch(url.pathname) trong code.Tự động dựa trên tên file trong /functions.Mục tiêuLàm API, Logic xử lý dữ liệu.Làm Web Full-stack (HTML tĩnh + API Functions).