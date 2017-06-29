{% if not(feeds is empty ) %}
	{% for feed in feeds %}
	<li>
		{{ link_to( ["for": "postView", "slug":  feed.pSlug, "id" : feed.pId   ], feed.pTitle , 'class' : 'solframe-link' , 'data-id' : feed.pId ) }}
		<div class="entry-meta"><a href="/users/{{ feed.uId }}">{{ feed.uUsername }}</a> - {{ getHumanDate( feed.feedDate )}} </div>
	</li>
	{% endfor %}
{% endif %}