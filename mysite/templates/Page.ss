<!doctype html>
<html class="no-js" lang="$ContentLocale">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
		<title><% if $URLSegment != 'home' %>$Title &raquo; <% end_if %>$SiteConfig.Title <% if $SiteConfig.Tagline %>
			| $SiteConfig.Tagline<% end_if %></title>
		<% base_tag %>
		<meta name="viewport" content="width=device-width"/>
		$MetaTags('false')
		<link rel="shortcut icon" href="{$BaseURL}favicon.ico?v=15"/>
		<%--<link rel="apple-touch-icon" href="{$BaseURL}favicon-180.png">--%>
		<%--<meta name="msapplication-TileImage" content="{$BaseURL}favicon-144.png">--%>
		<%--<meta name="msapplication-TileColor" content="#FFF">--%>
	</head>
	<body>
		<div class="page-container"<% if $URLSegment == 'home' %> id="home-top"<% end_if %>>
			<% include Header %>
			<div class="layout" role="main">
				$Layout
			</div>
			<% include Footer %>
		</div>
	</body>
</html>
