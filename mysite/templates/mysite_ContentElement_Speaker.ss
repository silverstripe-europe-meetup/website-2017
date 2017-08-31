<% with $Image.FillMax(150, 150) %>
	<div class="image">
		<div style="background-image: url('$URL');"></div>
	</div>
<% end_with %>
<h5>$Title</h5>
<% if $Content %>
	<p>$Content</p>
<% end_if %>
<div class="links">
	<% if $Website %>
		<div class="website">
			<a href="$Website" target="_blank" title="$Title.ATT">
				$WebsiteLinkTitle
			</a>
		</div>
	<% end_if %>
	<% if $TwitterHandle %>
		<div class="twitter">
			Twitter: <a href="$TwitterLink" target="_blank">@$TwitterHandle</a>
		</div>
	<% end_if %>
	<% if $GitHubHandle %>
		<div class="twitter">
			GitHub: <a href="$GitHubLink" target="_blank">@$GitHubHandle</a>
		</div>
	<% end_if %>
</div>


