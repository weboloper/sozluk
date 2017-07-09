{% extends "layouts/base.volt" %}
{% block content %}
{{ partial('partials/solframe')}}
<section id="content">
		<h1><a href="#">{{ query |  striptags }}</a></h1>

		 <ul id="entry-list">
 			
 			<p>henüz yok. aç</p>
 			{{ form( 'posts/entry', 'class' : 'entry-form'  ) }}
 				{{ form.render('content',[ 'id' : 'entry-content', 'rows' : 4 ]) }}
 				{{ form.render('postId') }}
 				{{ form.render('title', ['value' : query |  striptags ]) }}
 				<input type="hidden" name="<?= $this->security->getTokenKey() ?>" value="<?= $this->security->getToken() ?>">
 				<pre>? biçimlendirme: [[bkz]] <?php echo '{'.'{gbkz}}'; ?> </pre>
				<button>ekle</button>
			</form>
		 	 
		 </ul>
 
</section>
{% endblock %}