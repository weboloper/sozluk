{% extends "layouts/base.volt" %}
{% block content %}
{{ partial('partials/solframe')}}
<section id="content">
		<h1><a href="#">5 haziran 2017 katar krizi</a></h1>

		 <ul id="entry-list">
		 	<li>
		 		<a href="#" class="vote">▲</a>
		 		<div class="entry-meta"><a href="#">yazar adı</a> - 25 dk önce - <a data-toggle="collapse" href="#entry-1" aria-expanded="false" aria-controls="entry-1"><span></span></a></div>
		 		<div id="entry-1" class="collapse show">
			 		<div class="entry-content">Working Effectively with Legacy Code by Michael Feathers. It's a bit hard to wrap your brain around the Java and C++ examples unless you have experience with them, but the techniques are timeless. You may need to practice them extensively before you understand how important they are, though. In a recent book club we did at work, a common complaint was, "This just looks like common sense". Indeed it does... though the common sense is uncommonly hard to find when you are staring at the actual situations this book helps you with.
			 		</div>
			 		<div class="entry-footer"><div class="footer-links"><a href="#">bildir</a></div></div>
		 		</div>
		 	</li>

		 	<li>
		 		<a href="#" class="vote">▲</a>
		 		<div class="entry-meta"><a href="#">yazar adı</a> - 25 dk önce - <a data-toggle="collapse" href="#entry-2" aria-expanded="false" aria-controls="entry-2"><span></span></a></div>
		 		<div id="entry-2" class="collapse show">
			 		<div class="entry-content">Working Effectively with Legacy Code by Michael Feathers. It's a bit hard to wrap your brain around the Java and C++ examples unless you have experience with them, but the techniques
			 		</div>
			 		<div class="entry-footer"><div class="footer-links"><a href="#">bildir</a></div></div>
			 	</div>
		 	</li>

		 	<li>
		 		<a href="#" class="vote">▲</a>
		 		<div class="entry-meta"><a href="#">yazar adı</a> - 25 dk önce - <a data-toggle="collapse" href="#entry-3" aria-expanded="false" aria-controls="entry-3"><span></span></a></div>
		 		<div id="entry-3" class="collapse show">
			 		<div class="entry-content">Working Effectively with Legacy Code by Michael Feathers. It's a bit hard to wrap your brain around the Java and C++ examples unless you have experience with them, but the techniques
			 		</div>
			 		<div class="entry-footer"><div class="footer-links"><a href="#">bildir</a></div></div>
			 	</div>
		 	</li>

		 	<li>
		 		<a href="#" class="vote">▲</a>
		 		<div class="entry-meta"><a href="#">yazar adı</a> - 25 dk önce - <a data-toggle="collapse" href="#entry-4" aria-expanded="false" aria-controls="entry-4"><span></span></a></div>
		 		<div id="entry-4" class="collapse show">
			 		<div class="entry-content">Working Effectively with Legacy Code by Michael Feathers. It's a bit hard to wrap your brain around the Java and C++ examples unless you have experience with them, but the techniques
			 		</div>
			 		<div class="entry-footer"><div class="footer-links"><a href="#">bildir</a></div></div>
			 	</div>
		 	</li>


		 	<li>
		 		<a href="#" class="vote">▲</a>
		 		<div class="entry-meta"><a href="#">yazar adı</a> - 25 dk önce - <a data-toggle="collapse" href="#entry-5" aria-expanded="false" aria-controls="entry-5"><span></span></a></div>
		 		<div id="entry-5" class="collapse show">
			 		<div class="entry-content">Working Effectively with Legacy Code by Michael Feathers. It's a bit hard to wrap your brain around the Java and C++ examples unless you have experience with them, but the techniques
			 		</div>
			 		<div class="entry-footer"><div class="footer-links"><a href="#">bildir</a></div></div>
			 	</div>
		 	</li>

		 	<form class="entry-form">
				<textarea rows="6" name="entry" placeholder="entry gir"></textarea>
				<input name="parent" value="0" type="hidden">
				<pre>? biçimlendirme: [[bkz]] ((gbkz))</pre>
				<button>ekle</button>
			</form>
		 	 
		 </ul>
 
</section>
{% endblock %}