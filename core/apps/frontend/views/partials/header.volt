<header id="header">
  <div id="header-inner">
    
    <a id="logo" href="/">{{name}}</a>
    <div id="menu-right">
      {% if auth.isLogged() != true %}
      <a href="/session/login">gir</a>
      {% else %}
        {% if auth.isTrustModeration() == true %}
          <a href="/backend">admin</a> |
        {% endif %}
          <a href="/users/changePassword">şifre</a> |
          <a href="/session/logout">çık</a>
      {% endif %}
    </div>
    <div id="menu-left">
        <div class="visible-lg"><a href="/">son entryler</a> | <a href="/newposts">yeni başlıklar</a> </div>
        <div class="hidden-lg"><a href="/posts/newentries">son entryler</a> | <a href="/posts/newposts">yeni başlıklar</a> </div>
    </div>
    <form id="search-form" action="/"><input name="s" type="text" placeholder="getirir" autocomplete="false"><button type="submit">getir</button></form>
  </div>
</header>