{% if not(feeds is empty ) %}
	{% for feed in feeds %}
	<li>
		{{ link_to( ["for": "postView", "slug":  feed.getSlug(), "id" : feed.getId()   ], feed.getTitle() , 'class' : 'solframe-link' , 'data-id' : feed.getId() ) }}
		<div class="entry-meta"><a href="/user/{{ feed.user.id }}">{{ feed.user.username }}</a> - 25 dk önce</div>
	</li>
	{% endfor %}
{% endif %}