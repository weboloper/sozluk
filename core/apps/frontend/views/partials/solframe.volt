<aside id="sol-frame" class="visible-lg">
	<ol id="post-list" class="not-mobile">
		{% if not(feeds is empty ) %}
			{% for feed in feeds %}
			<li>
				{{ link_to( ["for": "postView", "slug":  feed.slug, "id" : feed.id   ], feed.title , 'class' : 'solframe-link' , 'data-id' : feed.id ) }}
				<div class="entry-meta"><a href="/users/{{ feed.uid }}">{{ feed.username }}</a> - {{ getHumanDate( feed.modifiedAt )}} </div>
			</li>
			{% endfor %}
		{% endif %}
	</ol>
	<a id="more" data-page="2" href="#">daha...</a>
</aside>