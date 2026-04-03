export async function onRequest(context) {
	const { request, env } = context;
	const url = new URL(request.url);

	const HOMEPAGE_URL = 'https://tutorial.cloudflareworkers.com/';
	const PROTECTED_TYPE = 'image/';

	// 1. Thực hiện fetch request gốc (lấy tài nguyên từ Assets hoặc Origin)
	// Trong Pages, bạn có thể dùng next() để đi tiếp luồng xử lý mặc định
	const response = await fetch(request);

	// 2. Kiểm tra Header
	const referer = request.headers.get('Referer');
	const contentType = response.headers.get('Content-Type') || '';

	// 3. Logic chặn Hotlink
	if (referer && contentType.startsWith(PROTECTED_TYPE)) {
		const refererHost = new URL(referer).hostname;
		const currentHost = url.hostname;

		if (refererHost !== currentHost) {
			// Nếu là hotlink, redirect về trang chủ
			return Response.redirect(HOMEPAGE_URL, 302);
		}
	}

	// 4. Mọi thứ ổn, trả về response bình thường
	return response;
}
