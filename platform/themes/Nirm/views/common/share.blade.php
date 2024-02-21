<div class="post-meta-share">
    <a class="btn btn-xs btn-slide btn-facebook" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($url) }}">
        <i class="fab fa-facebook-f"></i>
        <span>Facebook</span>
    </a>
    <a class="btn btn-xs btn-slide btn-twitter" href="https://twitter.com/intent/tweet?url={{ urlencode($url) }}&text={{urlencode($title)}}" data-width="100">
        <i class="fab fa-twitter"></i>
        <span>Twitter</span>
    </a>
    <a class="btn btn-xs btn-slide btn-linkedin" href="http://www.linkedin.com/shareArticle?mini=true&url={{ urlencode($url) }}&title={{urlencode($title)}}&summary={{urlencode($description)}}" data-width="118">
        <i class="fab fa-linkedin"></i>
        <span>LinkedIn</span>
    </a>
    <a class="btn btn-xs btn-slide btn-googleplus" href="mailto:?subject=I want to share this with you &amp;body= Hi there, Check out this site {{ urlencode($url) }}. Thanks." data-width="80">
        <i class="icon-mail"></i>
        <span>Mail</span>
    </a>
</div>