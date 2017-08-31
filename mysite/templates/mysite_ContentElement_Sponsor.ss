<% if $Website %>
	<a href="$Website" target="_blank" title="$Title.ATT">
<% end_if %>
<% with $Logo.FitMax(300, 150) %>
		<div class="image">
			<div style="background-image: url('$URL'); max-width: {$Width}px;"></div>
		</div>
<% end_with %>
<% if $Website %>
	</a>
<% end_if %>
<h5>$Title</h5>
<p>$Content</p>
<% if $Website %>
	<a href="$Website" target="_blank" title="$Title.ATT">
		<span class="website">$WebsiteLinkTitle</span>
	</a>
<% end_if %>

