<%--<div class="section page $PageExtraClass">--%>
<%--<div class="background-color background-color-white">--%>
<%--<div class="container">--%>
<%--<div class="container-inner">--%>
<%--<% if $Title %>--%>
<%--<div class="container-title">--%>
<%--<h2>$Title</h2>--%>
<%--</div>--%>
<%--<% end_if %>--%>
<%--$Content--%>
<%--$Form--%>
<%--</div>--%>
<%--</div>--%>
<%--</div>--%>
<%--</div>--%>

<% if $Content || $Form %>
	<div class="page-content">
		<div class="container">
			<div class="container-inner">
				<h2>$Title</h2>
				$Content
				<div class="clear"></div>
				$Form
				<div class="clear"></div>
			</div>
		</div>
	</div>
<% end_if %>
<div class="page-builder-grid">
	$PageBuilder.Value
</div>
