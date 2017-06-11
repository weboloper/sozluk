<aside id="sol-frame">
	<ol id="post-list">
		{% for feed in feeds %}
		<li>
			{{ link_to( ["for": "postView", "slug":  feed.getSlug(), "id" : feed.getId()   ], feed.getTitle() ) }}
			<div class="entry-meta"><a href="#">yazar adı</a> - 25 dk önce</div>
		</li>
		{% endfor %}
	</ol>
</aside>