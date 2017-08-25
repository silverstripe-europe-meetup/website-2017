<header class="header<% if $HeaderBackgroundImage %> has-header-image<% end_if %>">
	<div class="container">
		<div class="container-inner">
			<a href="$BaseURL#home-top" class="logo scroll">
				<h1>$SiteConfig.Title</h1>
			</a>
			<% if $Navigation %>
				<nav>
					<button class="toggle-nav"><span></span></button>
					<ul>
						<% loop $Navigation %>
							<li class="$FirstLast">
								<a class="scroll" href="$Link" title="$Title.XML">$MenuTitle</a>
							</li>
						<% end_loop %>
					</ul>
				</nav>
			<% end_if %>
		</div>
	</div>
</header>
<% if $HeaderBackgroundImage %>
	<div class="header-image">
		<div class="header-image-background" style="background-image: url('$HeaderBackgroundImage.URL');"></div>
		<div class="header-image-overlay"></div>
		<div class="container">
			<div class="container-inner">
				<div class="center">
					<div class="center-inner">
						<h1>
							<span>
								$HeaderTitle
							</span>
						</h1>
						<h2>
							<span>
								$HeaderSubTitle
							</span>
						</h2>
						$HeaderContent
					</div>
				</div>
			</div>
		</div>
	</div>
<% else %>
	<div class="header-push"></div>
<% end_if %>
