import { testHtml } from '../testpage/index.js';
export function onRequest(context) {
	return new Response(testHtml, {
        headers: { 'Content-Type': 'text/html' },
    });
}
