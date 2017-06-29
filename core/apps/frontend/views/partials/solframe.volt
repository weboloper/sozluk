<aside id="sol-frame" class="visible-lg">
	<ol id="post-list" class="not-mobile">
		{% if not(feeds is empty ) %}
			{% for feed in feeds %}
			<li>
				{{ dump(feed)}}
		 
			</li>
			{% endfor %}
		{% endif %}
	</ol>
	<a id="more" data-page="2" href="#">daha...</a>
</aside>