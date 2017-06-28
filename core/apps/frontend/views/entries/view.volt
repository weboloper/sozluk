{% extends "layouts/base.volt" %}
{% block content %}
{{ partial('partials/solframe')}}
<section id="content">
		<h1>{{ link_to( ["for": "postView", "slug":  post.getSlug(), "id" : post.getId()   ], post.getTitle() ) }}</h1>

		 <ul id="entry-list">
		 	{% for entry in entries %}
 		 	<li>
		 		<a href="#" class="vote">▲</a>
		 		<div class="entry-meta"><a href="#">{{ entry.user.username }}</a> - {{ date('h:m:i d/m/Y', entry.createdAt )}} - <a data-toggle="collapse" href="#entry-{{entry.getId()}}" aria-expanded="false" aria-controls="entry-{{entry.getId()}}"><span></span></a></div>
		 		<div id="entry-{{entry.getId()}}" class="collapse show">
			 		<div class="entry-content">{{ markdown(entry.getContent()) }}
			 		</div>
			 		<div class="entry-footer"><div class="footer-links">{% if auth['id'] == entry.getUserId() %} <a href="/entries/edit/{{entry.getId()}}">düzenle</a> -|{% endif %} <a href="#">bildir</a></div></div>
		 		</div>
		 	</li>
		 	{% endfor %}
		 	 
		 </ul>
 
</section>
{% endblock %}