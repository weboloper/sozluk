{% extends "layouts/base.volt" %}
{% block content %}
{{ partial('partials/solframe')}}
<section id="content">
 		
 		<h1>{{ link_to( ["for": "postView", "slug":  post.getSlug(), "id" : post.getId()   ], post.getTitle() ) }}</h1>
 		
		 <ul id="entry-list">

		 	{{ form( 'entries/save/' ~ entry.getId()  , 'class' : 'entry-form'  ) }}
 				{{ form.render('content',[ 'id' : 'entry-content', 'rows' : 4  ]) }}
 				{{ form.render('postId' ) }}
 				{{ form.render('title', ['value' : post.getTitle() ]) }}
  				<pre>? biçimlendirme: [[bkz]] ((gbkz))</pre>
				<button>ekle</button>
				<input type="hidden" name="<?= $this->security->getTokenKey() ?>" value="<?= $this->security->getToken() ?>">
			</form>
		 	 
		 </ul>
 
</section>
{% endblock %}