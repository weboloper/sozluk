<h1>{{ link_to( ["for": "postView", "slug":  post.getSlug(), "id" : post.getId()   ], post.getTitle()   ) }}</h1>


 <ul id="entry-list">

 	{% for entry in entries %}

	 	<li>
 		<a href="#" class="vote">▲</a>
 		<div class="entry-meta"><a href="/users/{{ entry.user.id }}">{{ entry.user.username }}</a> -  {{ getHumanDate(entry.createdAt)  }}  - <a data-toggle="collapse" href="#entry-{{entry.getId()}}" aria-expanded="false" aria-controls="entry-{{entry.getId()}}"><span></span></a></div>
 		<div id="entry-{{entry.getId()}}" class="collapse show">
	 		<div class="entry-content">{{ markdown(entry.getContent()) }}
	 		</div>
	 		<div class="entry-footer"><div class="footer-links">{% if auth['id'] == entry.getUserId() %} <a href="/entries/edit/{{entry.getId()}}">düzenle</a> - {% endif %} <a href="#">bildir</a></div></div>
 		</div>
 	</li>
 	{% endfor %}
 	 

 	{{ form( 'posts/entry/' ~ post.getId(), 'class' : 'entry-form'  ) }}
			{{ form.render('content',[ 'id' : 'entry-content', 'rows' : 4 ]) }}
			{{ form.render('postId', ['value' : post.getId() ]) }}
			{{ form.render('title', ['value' : post.getTitle() | striptags ]) }}
			<input type="hidden" name="<?= $this->security->getTokenKey() ?>" value="<?= $this->security->getToken() ?>">
			<pre>? biçimlendirme: [[bkz]] <?php echo '{'.'{gbkz}}'; ?> </pre>
		<button>ekle</button>
	</form>
 	 
 </ul>