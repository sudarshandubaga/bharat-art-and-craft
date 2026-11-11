@extends('layouts.app')

@section('title', ($blog ? $blog->title . ' — ' : '') . 'Bharat Art & Craft Journal')
@section('meta_description', Str::limit(strip_tags($blog->description ?? $blog->excerpt ?? 'Explore stories about handcrafted woodwork and timber design principles.'), 160))

@section('content')
<h1 class="sr-only">Journal — {{ $blog->title ?? 'Article' }}</h1>

      <!-- READING PROGRESS BAR -->
      <div id="tft-post-scroll-progress" class="tft-post-progress"></div>

      <!-- POST HERO SECTION -->
      <section class="tft-post-hero" id="wp-block-post-hero">
        <img class="tft-post-hero__img" src="{{ $blog->image_url ?? asset('assets/img/fur_room_living.png') }}" alt="{{ $blog->title ?? 'Journal Article' }}" width="1920" height="700" loading="eager">
        <div class="tft-post-hero__overlay"></div>
        <div class="tft-post-hero__content">
          <div class="tft-post-hero__breadcrumb">
            <a href="{{ route('home') }}">Home</a> &nbsp;&rarr;&nbsp; 
            <a href="{{ route('blog') }}">Journal</a> &nbsp;&rarr;&nbsp; 
            <span>{{ $blog->category_name ?? 'Craft & Heritage' }}</span>
          </div>
          <span class="tft-post-hero__tag">{{ $blog->category_name ?? 'Craft & Heritage' }}</span>
          <h2 class="tft-post-hero__title">{{ $blog->title ?? 'Stories for Better Living' }}</h2>
          <div class="tft-post-hero__meta">
            <img class="tft-post-hero__author-img" src="{{ asset('assets/img/about_artisan_elena.png') }}" alt="Bharat Art & Craft" width="36" height="36" loading="lazy">
            <span>By <strong>Bharat Art &amp; Craft Studio</strong></span>
            <span>&bull;</span>
            <span>{{ $blog->created_at ? $blog->created_at->format('F d, Y') : 'Recent' }}</span>
            <span>&bull;</span>
            <span>5 min read</span>
          </div>
        </div>
      </section>

      <!-- POST GRID / LAYOUT -->
      <div class="tft-post-layout">
        
        <!-- Left: Article Content -->
        <article class="tft-post-article" id="wp-block-post-article">
          @if($blog && $blog->excerpt)
          <div class="tft-post-article__lede">
            {{ $blog->excerpt }}
          </div>
          @endif
          <div class="tft-post-article__body">
            @if($blog && $blog->description)
              {!! $blog->description !!}
            @else
              <p>Content for this article is being updated.</p>
            @endif
          </div>

          <!-- Article Tags -->
          <div class="tft-post-article__tags">
            <a href="#" class="tft-post-article__tag">Japandi</a>
            <a href="#" class="tft-post-article__tag">Minimalism</a>
            <a href="#" class="tft-post-article__tag">Space Planning</a>
            <a href="#" class="tft-post-article__tag">Oak Sourcing</a>
          </div>

          <!-- AUTHOR BOX -->
          <section class="tft-author-box" id="wp-block-post-author-box">
            <img class="tft-author-box__img" src="{{ asset('assets/img/about_artisan_elena.png') }}" alt="Elena Rostova" width="96" height="96" loading="lazy">
            <div>
              <span class="tft-author-box__label">About the Author</span>
              <h3 class="tft-author-box__name">Elena Rostova</h3>
              <p class="tft-author-box__bio">Elena is a Moscow-born, Copenhagen-based spatial designer. She specializes in low-profile joinery design, Japanese joinery systems, and raw mineral finishes.</p>
              <div class="tft-author-box__links">
                <a href="#" class="tft-author-box__link">View Portfolio &rarr;</a>
                <a href="#" class="tft-author-box__link">Follow on Instagram &rarr;</a>
              </div>
            </div>
          </section>

          <!-- COMMENTS TREE SECTION -->
          <section class="tft-comments" id="wp-block-post-comments">
            <h3 class="tft-comments__heading">
              Discussion <span class="tft-comments__count" id="tft-comment-counter">3</span>
            </h3>

            <!-- Comment List Tree -->
            <div class="tft-comment-list" id="tft-comments-tree-root">
              
              <!-- Comment 1 -->
              <div class="tft-comment" id="comment-1">
                <img class="tft-comment__avatar" src="{{ asset('assets/img/about_artisan_soren.png') }}" alt="Soren Hansen" width="44" height="44" loading="lazy">
                <div class="tft-comment__body">
                  <div class="tft-comment__header">
                    <span class="tft-comment__author">Soren Hansen</span>
                    <span class="tft-comment__badge">Artisan</span>
                    <span class="tft-comment__date">May 13, 2026</span>
                  </div>
                  <p class="tft-comment__text">The discussion of <em>Ma</em> is spot on. Applying this to our workshop benches has completely changed how we organize our tool racks. Exceptional write-up, Elena!</p>
                  <div class="tft-comment__actions">
                    <button class="tft-comment__action" data-tft-click="comment-reply" data-tft-comment-id="comment-1" data-tft-author="Soren Hansen">
                      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 14 20 9 15 4"/><path d="M4 20v-7a4 4 0 0 1 4-4h12"/></svg>
                      Reply
                    </button>
                    <button class="tft-comment__action" data-tft-click="comment-like">
                      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"/></svg>
                      <span>4</span> Likes
                    </button>
                  </div>
                </div>
              </div>

              <!-- Comment 1 child reply -->
              <div class="tft-comment tft-comment--child" id="comment-2">
                <div class="tft-comment__avatar--placeholder">K</div>
                <div class="tft-comment__body">
                  <div class="tft-comment__header">
                    <span class="tft-comment__author">Kristian Lind</span>
                    <span class="tft-comment__date">May 14, 2026</span>
                  </div>
                  <p class="tft-comment__text">I agree Soren. The choice of joints really determines the structural longevity of low benches.</p>
                  <div class="tft-comment__actions">
                    <button class="tft-comment__action" data-tft-click="comment-reply" data-tft-comment-id="comment-2" data-tft-author="Kristian Lind">
                      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 14 20 9 15 4"/><path d="M4 20v-7a4 4 0 0 1 4-4h12"/></svg>
                      Reply
                    </button>
                    <button class="tft-comment__action" data-tft-click="comment-like">
                      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"/></svg>
                      <span>1</span> Like
                    </button>
                  </div>
                </div>
              </div>

              <!-- Comment 2 -->
              <div class="tft-comment" id="comment-3">
                <div class="tft-comment__avatar--placeholder">M</div>
                <div class="tft-comment__body">
                  <div class="tft-comment__header">
                    <span class="tft-comment__author">Marc Dubois</span>
                    <span class="tft-comment__date">May 15, 2026</span>
                  </div>
                  <p class="tft-comment__text">Can you recommend specific oil finishes that protect raw oak while keeping the matte look? I've had issues with linseed turning oak too yellow.</p>
                  <div class="tft-comment__actions">
                    <button class="tft-comment__action" data-tft-click="comment-reply" data-tft-comment-id="comment-3" data-tft-author="Marc Dubois">
                      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 14 20 9 15 4"/><path d="M4 20v-7a4 4 0 0 1 4-4h12"/></svg>
                      Reply
                    </button>
                    <button class="tft-comment__action" data-tft-click="comment-like">
                      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"/></svg>
                      <span>2</span> Likes
                    </button>
                  </div>
                </div>
              </div>

            </div>

            <!-- COMMENT FORM WITH AUTHBOX -->
            <div class="tft-comment-form" id="tft-post-comment-form-container">
              <h4 class="tft-comment-form__heading">Leave a Thought</h4>
              
              <!-- AUTH BOX (authgobox) -->
              <div id="tft-authbox-container" style="margin-bottom:20px; padding:16px; border:1px solid var(--fur-border); border-radius:var(--fur-radius-md); background:var(--fur-bg-secondary);">
                <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px;">
                  <div>
                    <h5 style="margin:0 0 4px; font-family:var(--fur-font-serif); font-size:0.9rem; font-weight:700; color:var(--fur-text);">Join the Discussion</h5>
                    <p style="margin:0; font-family:var(--fur-font-sans); font-size:0.75rem; color:var(--fur-text-muted);">Sign in to save your name and custom avatar.</p>
                  </div>
                  <div style="display:flex; gap:8px;">
                    <button type="button" class="tft-blog-filter-btn" style="padding-inline:12px; padding-block:5px; font-size:0.7rem;" data-tft-click="comment-login" data-tft-provider="Atelier ID">Atelier ID</button>
                    <button type="button" class="tft-blog-filter-btn" style="padding-inline:12px; padding-block:5px; font-size:0.7rem;" data-tft-click="comment-login" data-tft-provider="Google">Google</button>
                    <button type="button" class="tft-blog-filter-btn" style="padding-inline:12px; padding-block:5px; font-size:0.7rem;" data-tft-click="comment-login" data-tft-provider="Apple">Apple</button>
                  </div>
                </div>
                <div id="tft-authbox-status" style="display:none; margin-top:8px; font-family:var(--fur-font-sans); font-size:0.75rem; color:var(--fur-primary); font-weight:600;"></div>
              </div>

              <!-- REPLYING TO NOTIFIER -->
              <div id="tft-replying-notifier" style="display:none; align-items:center; justify-content:space-between; margin-bottom:14px; padding:8px 12px; background:var(--fur-sidebar-active); border-radius:var(--fur-radius-sm); font-family:var(--fur-font-sans); font-size:0.78rem; color:var(--fur-primary);">
                <span>Replying to <strong id="tft-reply-target-name"></strong></span>
                <button type="button" data-tft-click="comment-cancel-reply" style="background:none; border:none; color:var(--fur-primary); font-weight:700; cursor:pointer;">Cancel</button>
              </div>

              <form id="tft-blog-comment-form" data-tft-submit="comment-submit">
                <div class="tft-comment-form__grid">
                  <div class="tft-comment-form__field">
                    <label class="tft-comment-form__label" for="comment-author-name">Name</label>
                    <input class="tft-comment-form__input" type="text" id="comment-author-name" required placeholder="E.g., Clara Lind">
                  </div>
                  <div class="tft-comment-form__field">
                    <label class="tft-comment-form__label" for="comment-author-email">Email</label>
                    <input class="tft-comment-form__input" type="email" id="comment-author-email" required placeholder="clara@example.com">
                  </div>
                  <div class="tft-comment-form__field tft-comment-form__field--full">
                    <label class="tft-comment-form__label" for="comment-text-content">Message</label>
                    <textarea class="tft-comment-form__textarea" id="comment-text-content" required placeholder="Write your thoughts..."></textarea>
                  </div>
                </div>
                <button class="tft-comment-form__submit" type="submit">
                  <span>Submit Comment</span>
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                </button>
              </form>
            </div>
          </section>

        </article>

        <!-- Right: Premium Custom Sidebar -->
        <aside class="tft-post-sidebar" aria-label="Article Sidebar">
          
          <!-- Widget: Meet Elena -->
          <div class="tft-widget">
            <div class="tft-widget__header">
              <span class="tft-widget__icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
              </span>
              <h4 class="tft-widget__title">The Designer</h4>
            </div>
            <div class="tft-widget__body">
              <div class="tft-widget-author">
                <img class="tft-widget-author__img" src="{{ asset('assets/img/about_artisan_elena.png') }}" alt="Elena Rostova" width="72" height="72" loading="lazy">
                <span class="tft-widget-author__name">Elena Rostova</span>
                <span class="tft-widget-author__role">Lead Architect</span>
                <p class="tft-widget-author__bio">Elena curates our spatial geometries and natural linen textures.</p>
                <a href="{{ route('about') }}" class="tft-widget-author__btn">Meet Elena</a>
              </div>
            </div>
          </div>

          <!-- Widget: Related Stories -->
          <div class="tft-widget">
            <div class="tft-widget__header">
              <span class="tft-widget__icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
              </span>
              <h4 class="tft-widget__title">Related Stories</h4>
            </div>
            <div class="tft-widget__body">
              <div class="tft-widget-related">
                @foreach($recentBlogs as $rb)
                <a href="{{ route('blog.single', $rb->slug) }}" class="tft-widget-related__item">
                  <img class="tft-widget-related__img" src="{{ $rb->image_url }}" alt="{{ $rb->title }}" width="72" height="56" loading="lazy">
                  <div>
                    <h5 class="tft-widget-related__title">{{ $rb->title }}</h5>
                    <div class="tft-widget-related__date">{{ $rb->created_at?->format('M d, Y') ?? 'Recent' }}</div>
                  </div>
                </a>
                @endforeach
              </div>
            </div>
          </div>

          <!-- Widget: Categories -->
          <div class="tft-widget">
            <div class="tft-widget__header">
              <span class="tft-widget__icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
              </span>
              <h4 class="tft-widget__title">Categories</h4>
            </div>
            <div class="tft-widget__body">
              <div class="tft-widget-cats">
                <a href="{{ route('blog', ['category' => 'design']) }}" class="tft-widget-cats__item">
                  <span>Design Philosophy</span>
                  <span class="tft-widget-cats__count">8</span>
                </a>
                <a href="{{ route('blog', ['category' => 'sustainability']) }}" class="tft-widget-cats__item">
                  <span>Sourcing &amp; Pledge</span>
                  <span class="tft-widget-cats__count">4</span>
                </a>
                <a href="{{ route('blog', ['category' => 'planning']) }}" class="tft-widget-cats__item">
                  <span>Space Planning</span>
                  <span class="tft-widget-cats__count">5</span>
                </a>
              </div>
            </div>
          </div>

          <!-- Widget: Featured Atelier Piece -->
          <div class="tft-widget">
            <div class="tft-widget__header">
              <span class="tft-widget__icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 8v8M8 12h8"/></svg>
              </span>
              <h4 class="tft-widget__title">Featured Design</h4>
            </div>
            <div class="tft-widget__body">
              <div class="tft-widget-product">
                <img class="tft-widget-product__img" src="{{ asset('assets/img/fp_table_coffee_travertine.png') }}" alt="Travertine Coffee Table" width="280" height="210" loading="lazy">
                <h5 class="tft-widget-product__name">Travertine Coffee Table</h5>
                <p class="tft-widget-product__desc">Italian travertine block coffee table featuring rounded architectural leg structures and a satin finish.</p>
                <div class="tft-widget-product__price">$1,450.00</div>
                <a href="{{ route('product.single') }}" class="tft-widget-product__btn">Explore Piece</a>
              </div>
            </div>
          </div>

          <!-- Widget: Tags Cloud -->
          <div class="tft-widget">
            <div class="tft-widget__header">
              <span class="tft-widget__icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>
              </span>
              <h4 class="tft-widget__title">Tags</h4>
            </div>
            <div class="tft-widget__body">
              <div class="tft-widget-tags">
                <a href="#" class="tft-widget-tag">Japandi</a>
                <a href="#" class="tft-widget-tag">Linen</a>
                <a href="#" class="tft-widget-tag">Oak</a>
                <a href="#" class="tft-widget-tag">Ma</a>
                <a href="#" class="tft-widget-tag">FSC Wood</a>
                <a href="#" class="tft-widget-tag">Joinery</a>
              </div>
            </div>
          </div>

        </aside>

      </div>

      <!-- FOOTER -->
      <!-- SYSTEM LEVEL: FOOTER (PREMIUM REBUILD) -->
@endsection
