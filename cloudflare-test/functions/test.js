import { testHtml } from '../testpage/index.js';

export function onRequest(context) {
	const viteScripts = `
    <script type="module" src="http://localhost:5173/@vite/client"></script>
    <script type="module" src="http://localhost:5173/vite/main.js"></script>
    `;

	// 1. Biến chuỗi HTML thành một đối tượng Response
	const originalResponse = new Response(testHtml, {
		headers: { 'Content-Type': 'text/html' },
	});

	// 2. Cho HTMLRewriter "xào nấu" cái Response đó
	return new HTMLRewriter()
		.on('head', {
			element(element) {
				element.append(viteScripts, { html: true });
			},
		})
		.transform(originalResponse); // Truyền vào Response, không phải String
}
