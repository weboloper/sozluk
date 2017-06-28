<aside id="sol-frame" class="visible-lg">
	<ol id="post-list" class="not-mobile">
		{% if not(feeds is empty ) %}
			{% for feed in feeds %}
			<li>
				{{ link_to( ["for": "postView", "slug":  feed.getSlug(), "id" : feed.getId()   ], feed.getTitle() , 'class' : 'solframe-link' , 'data-id' : feed.getId() ) }}
				<div class="entry-meta"><a href="/users/{{ feed.user.id }}">{{ feed.user.username }}</a> - 25 dk önce</div>
			</li>
			{% endfor %}
		{% endif %}
	</ol>
	<a id="more" data-page="2" href="#">daha...</a>
</aside>