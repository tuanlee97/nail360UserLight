<?php

if (isset($_COOKIE['token'])) {
	$token = $_COOKIE['token'];
	// Make a GET request to the API endpoint
	$url = $_adminApi . "/user/profile";
	// Set request headers
	$headers = array(
		'Authorization: Bearer ' . $token,
		'Content-Type: application/json'
	);
	// Set request options
	$options = array(
		CURLOPT_URL => $url,
		CURLOPT_POST => true,
		CURLOPT_HTTPHEADER => $headers,
		CURLOPT_RETURNTRANSFER => true
	);

	// Initialize curl session
	$ch = curl_init();

	// Set curl options
	curl_setopt_array($ch, $options);

	// Execute curl request and get response
	$profile = json_decode(curl_exec($ch), true);
	// Close curl session
	curl_close($ch);

	$_isLogin = isset($profile['error']) ? false : true;
	if (isset($profile['error'])) {
		unset($_COOKIE['token']);
		setcookie('token', null, -1);
		//header("Location: ".$_SERVER['REQUEST_URI']);
	}
} else $_isLogin = false;
$temporary_src_img = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mM8XQ8AAhsBTLgo62UAAAAASUVORK5CYII=";
// var_dump($_COOKIE['token']);
// echo "<pre>";
//  var_dump($profile);
//  echo "</pre>";
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php if (isset($GLOBALS['page_meta']) && count($GLOBALS['page_meta']) > 0) : ?>
		<!-- Primary Meta Tags -->
		<title><?= $GLOBALS['page_meta']["meta_title"] ?></title>
		<meta name="title" content="<?= $GLOBALS['page_meta']["meta_title"] ?>" />
		<meta name="description" content="<?= $GLOBALS['page_meta']["meta_description"] ?>" />

		<!-- Open Graph / Facebook -->
		<meta property="og:type" content="website" />
		<meta property="og:url" content="https://www.facebook.com/" />
		<meta property="og:title" content="<?= $GLOBALS['page_meta']["meta_title"] ?>" />
		<meta property="og:description" content="<?= $GLOBALS['page_meta']["meta_description"] ?>" />
		<meta property="og:image" content="<?= $GLOBALS['page_meta']["meta_image"] ?>" />

		<!-- Twitter -->
		<meta property="twitter:card" content="summary_large_image" />
		<meta property="twitter:url" content="https://twitter.com/" />
		<meta property="twitter:title" content="<?= $GLOBALS['page_meta']["meta_title"] ?>" />
		<meta property="twitter:description" content="<?= $GLOBALS['page_meta']["meta_description"] ?>" />
		<meta property="twitter:image" content="<?= $GLOBALS['page_meta']["meta_image"] ?>" />
	<?php else : ?>
		<title>Nail360</title>
	<?php endif ?>

	<!-- Favicon -->
	<link rel="icon" type="image/png" href="<?= $_rootPath ?>/views/nail360/assets/favicon/favicon.png">
	<!--Bootstrap CSS & JS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
	<!--Nail360 CSS-->
	<link href="<?php echo $_rootPath ?>/assets/css/mulish-fonts.css" rel="stylesheet">
	<link href="<?php echo $_rootPath ?>/views/nail360/assets/css/n360_main.css?v=1" rel="stylesheet">

	<?php
	if (isset($GLOBALS['link_css']))
		foreach ($GLOBALS['link_css'] as $link) : ?>
		<link href="<?= $_rootPath ?>/views/nail360/assets/css/<?= $link ?>" rel="stylesheet">
	<?php endforeach; ?>
	<!-- Jquery -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	
	<script type="text/javascript">
		window._rootPath = "<?php echo $_rootPath ?>";
		window._adminApi = "<?php echo $_adminApi ?>";
		window._domain = "<?php echo $_domain ?>";
	</script>
</head>

<body class="position-relative">
	<ul id="menu">
		<div id="close-expand-menu" class="text-end cursor-pointer">
			<svg width="24" height="24" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M11.7197 11.7344C11.5088 11.9453 11.1221 11.9453 10.9111 11.7344L6.27051 7.05859L1.59473 11.7344C1.38379 11.9453 0.99707 11.9453 0.786133 11.7344C0.575195 11.5234 0.575195 11.1367 0.786133 10.9258L5.46191 6.25L0.786133 1.60938C0.575195 1.39844 0.575195 1.01172 0.786133 0.800781C0.99707 0.589844 1.38379 0.589844 1.59473 0.800781L6.27051 5.47656L10.9111 0.800781C11.1221 0.589844 11.5088 0.589844 11.7197 0.800781C11.9307 1.01172 11.9307 1.39844 11.7197 1.60938L7.04395 6.25L11.7197 10.9258C11.9307 11.1367 11.9307 11.5234 11.7197 11.7344Z"/>
			</svg>
		</div>

		<a class="text-decoration-none text-white fsize-4" href="#">
			<li class="menu__item mulish-bold mb-2">Home</li>
		</a>
		<a class="text-decoration-none text-white fsize-4" href="#">
			<li class="menu__item mulish-bold mb-2">About</li>
		</a>
		<a class="text-decoration-none text-white fsize-4" href="#">
			<li class="menu__item mulish-bold mb-2">Info</li>
		</a>
		<a class="text-decoration-none text-white fsize-4" href="#">
			<li class="menu__item mulish-bold mb-2">Contact</li>
		</a>
		<a class="text-decoration-none text-white fsize-4" href="#">
			<li class="menu__item mulish-bold mb-2">Show me more</li>
		</a>
	</ul>
	<header class="site-header bg-n360-dark ">
		<div class="header-wrap section-wrap position-relative">
			<nav class="navbar header__navbar header__navbar--wrap py-20px">
				<div class="navbar__logo">
					<a href="<?php echo $_rootPath; ?>" class="navbar__logo--url">
						<img src="<?php echo $_rootPath ?>/views/nail360/assets/img/logo/site-logo.svg" />
					</a>
				</div>
				<div class="search-form-container search-form-container--hidden">
					<form id="search-form" action="<?php echo $_rootPath; ?>/search" method="post" class="m-0 d-flex align-items-center justify-content-between fsize-2 navbar__search gap-3 bg-white <?php if ($_isLogin) : ?> flex-grow-0pt6 <?php endif; ?>">
						<input type="text" name="name" value="<?php echo $_POST['search']['name']; ?>" class="search_name border-0 ms-4 outline-none" placeholder="Search by name" />
						<span class="vertical-divider"></span>
						<div class="d-flex align-items-center flex-grow-1">
							<span class="mx-2"><img src="<?php echo $_rootPath ?>/views/nail360/assets/icons/location-dot.svg" /></span>
							<input type="text" name="address" value="<?php echo $_POST['search']['address']; ?>" class="search_address border-0 flex-grow-1 outline-none" placeholder="Address, city state or zip" />
						</div>
						<button type="submit" class="border-0 rounded-circle circle__search_btn d-flex justify-content-center align-items-center bg-main">
							<svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M19.6875 18.9507C20.0781 19.3413 20.0781 19.9272 19.6875 20.2788C19.5312 20.4741 19.2969 20.5522 19.0625 20.5522C18.7891 20.5522 18.5547 20.4741 18.3594 20.2788L13.125 15.0444C11.7188 16.1772 9.96094 16.8022 8.08594 16.8022C3.63281 16.8022 0 13.1694 0 8.67725C0 4.22412 3.59375 0.552246 8.08594 0.552246C12.5391 0.552246 16.2109 4.22412 16.2109 8.67725C16.2109 10.5913 15.5859 12.3491 14.4531 13.7163L19.6875 18.9507ZM1.875 8.67725C1.875 12.1538 4.64844 14.9272 8.125 14.9272C11.5625 14.9272 14.375 12.1538 14.375 8.67725C14.375 5.23975 11.5625 2.42725 8.125 2.42725C4.64844 2.42725 1.875 5.23975 1.875 8.67725Z" fill="white" />
							</svg>
						</button>
					</form>
				</div>
				<button type="button" class="d-none border-0 radius-300 mulish-bold businesses-btn  d-xl-block ">For Businesses</button>
				<?php if ($_isLogin) : ?>
					<div class="profile-user">
						<div class="cursor-pointer login-chat" data-message="<?= $profile["message"] ?>">
							<svg height="20" aria-hidden="true" data-prefix="far" data-icon="comment-lines" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-comment-lines fa-w-16 fa-7x">
								<path fill="currentColor" d="M368 168H144c-8.8 0-16 7.2-16 16v16c0 8.8 7.2 16 16 16h224c8.8 0 16-7.2 16-16v-16c0-8.8-7.2-16-16-16zm-96 96H144c-8.8 0-16 7.2-16 16v16c0 8.8 7.2 16 16 16h128c8.8 0 16-7.2 16-16v-16c0-8.8-7.2-16-16-16zM256 32C114.6 32 0 125.1 0 240c0 47.6 19.9 91.2 52.9 126.3C38 405.7 7 439.1 6.5 439.5c-6.6 7-8.4 17.2-4.6 26S14.4 480 24 480c61.5 0 110-25.7 139.1-46.3C192 442.8 223.2 448 256 448c141.4 0 256-93.1 256-208S397.4 32 256 32zm0 368c-26.7 0-53.1-4.1-78.4-12.1l-22.7-7.2-19.5 13.8c-14.3 10.1-33.9 21.4-57.5 29 7.3-12.1 14.4-25.7 19.9-40.2l10.6-28.1-20.6-21.8C69.7 314.1 48 282.2 48 240c0-88.2 93.3-160 208-160s208 71.8 208 160-93.3 160-208 160z" class=""></path>
							</svg>
						</div>
						<div class="cursor-pointer login-notify" data-noti="<?= $profile["noti"] ?>">
							<svg height="20" aria-hidden="true" data-prefix="far" data-icon="bell" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-bell fa-w-14 fa-7x">
								<path fill="currentColor" d="M439.39 362.29c-19.32-20.76-55.47-51.99-55.47-154.29 0-77.7-54.48-139.9-127.94-155.16V32c0-17.67-14.32-32-31.98-32s-31.98 14.33-31.98 32v20.84C118.56 68.1 64.08 130.3 64.08 208c0 102.3-36.15 133.53-55.47 154.29-6 6.45-8.66 14.16-8.61 21.71.11 16.4 12.98 32 32.1 32h383.8c19.12 0 32-15.6 32.1-32 .05-7.55-2.61-15.27-8.61-21.71zM67.53 368c21.22-27.97 44.42-74.33 44.53-159.42 0-.2-.06-.38-.06-.58 0-61.86 50.14-112 112-112s112 50.14 112 112c0 .2-.06.38-.06.58.11 85.1 23.31 131.46 44.53 159.42H67.53zM224 512c35.32 0 63.97-28.65 63.97-64H160.03c0 35.35 28.65 64 63.97 64z" class=""></path>
							</svg>
						</div>
						<div class="position-relative">
							<div class="cursor-pointer profile dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-message="<?= $profile["message"] ?>">
								<img src="<?= $temporary_src_img ?>" lazy-src="<?= $_adminApi . '/images' . $profile["content"]["avatar"] ?>" src-alt="<?= $profile["name"] ?>" />
							</div>
							<ul class="dropdown-menu profile-menu">
								<li>
									<a class="dropdown-item profile-menu--item" href="#">
										<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
											<path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
										</svg>
										About me
									</a>
								</li>
								<li>
									<a class="dropdown-item profile-menu--item" href="#">
										<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
											<path d="M464 256A208 208 0 1 0 48 256a208 208 0 1 0 416 0zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm169.8-90.7c7.9-22.3 29.1-37.3 52.8-37.3h58.3c34.9 0 63.1 28.3 63.1 63.1c0 22.6-12.1 43.5-31.7 54.8L280 264.4c-.2 13-10.9 23.6-24 23.6c-13.3 0-24-10.7-24-24V250.5c0-8.6 4.6-16.5 12.1-20.8l44.3-25.4c4.7-2.7 7.6-7.7 7.6-13.1c0-8.4-6.8-15.1-15.1-15.1H222.6c-3.4 0-6.4 2.1-7.5 5.3l-.4 1.2c-4.4 12.5-18.2 19-30.6 14.6s-19-18.2-14.6-30.6l.4-1.2zM224 352a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z" />
										</svg>
										Help
									</a>
								</li>
								<li>
									<a class="dropdown-item profile-menu--item" href="#" onclick="document.cookie = 'token=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;'; window.location.reload();">
										<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
											<path d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z" />
										</svg>
										Log Out
									</a>
								</li>
							</ul>
						</div>
					</div>
				<?php else : ?>
					<?php include __DIR__ . '/../inc/components/modal_login.php'; ?>
					<button type="button" class="d-none border-0 radius-300 mulish-bold login-btn d-xl-block" data-bs-toggle="modal" data-bs-target="#login">Log In</button>
					<button type="button" class="d-none border-0 radius-300 mulish-bold signup-btn d-xl-block" data-bs-toggle="modal" data-bs-target="#signUp">Sign Up</button>
				<?php endif ?>
				<div class="d-block d-xl-none mobile-action-menu">
					<span class="me-3 mobile-search-btn">
						<svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M19.6875 18.8984C20.0781 19.2891 20.0781 19.875 19.6875 20.2266C19.5312 20.4219 19.2969 20.5 19.0625 20.5C18.7891 20.5 18.5547 20.4219 18.3594 20.2266L13.125 14.9922C11.7188 16.125 9.96094 16.75 8.08594 16.75C3.63281 16.75 0 13.1172 0 8.625C0 4.17188 3.59375 0.5 8.08594 0.5C12.5391 0.5 16.2109 4.17188 16.2109 8.625C16.2109 10.5391 15.5859 12.2969 14.4531 13.6641L19.6875 18.8984ZM1.875 8.625C1.875 12.1016 4.64844 14.875 8.125 14.875C11.5625 14.875 14.375 12.1016 14.375 8.625C14.375 5.1875 11.5625 2.375 8.125 2.375C4.64844 2.375 1.875 5.1875 1.875 8.625Z" fill="#D3427A" />
						</svg>
					</span>
					<span>
						<input type="checkbox" id="expand-menu" />
						<label class="cursor-pointer expand-menu" for="expand-menu">
							<svg width="30" height="20" viewBox="0 0 30 20" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M3.33333 9.58334C3.33333 8.89299 3.89297 8.33334 4.58333 8.33334H28.75C29.4404 8.33334 30 8.89299 30 9.58334C30 10.2737 29.4403 10.8333 28.75 10.8333H4.58333C3.89297 10.8333 3.33333 10.2737 3.33333 9.58334Z" fill="#D3427A" />
								<path d="M0 17.9167C0 17.2263 0.559644 16.6667 1.25 16.6667H25.4167C26.107 16.6667 26.6667 17.2263 26.6667 17.9167C26.6667 18.607 26.107 19.1667 25.4167 19.1667H1.25C0.559642 19.1667 0 18.607 0 17.9167Z" fill="#D3427A" />
								<path d="M0 1.25C0 0.559644 0.559644 0 1.25 0H25.4167C26.107 0 26.6667 0.559644 26.6667 1.25C26.6667 1.94036 26.107 2.5 25.4167 2.5H1.25C0.559642 2.5 0 1.94036 0 1.25Z" fill="#D3427A" />
							</svg>
						</label>
					</span>

				</div>
			</nav>
		</div>

	</header>

	<main>