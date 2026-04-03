// import { testHtml } from '../testpage/index.js';
// export function onRequest(context) {
// 	return new Response('<p>Hello, world page!</p>', {
//         headers: { 'Content-Type': 'text/html' },
//     });
// }

export function onRequest(context) {
	const { path } = context.params;
	// path sẽ là ["abc"] hoặc ["123"]
	return new Response(`Hello, world page! Bạn đang ở: ${path}`);
}