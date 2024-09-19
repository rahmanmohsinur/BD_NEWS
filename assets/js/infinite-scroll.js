jQuery(document).ready(function($) {
    var loading = false;
    var offset = 1; // Start loading from the second post (next post)

    $(window).scroll(function() {
        // Check if scrolled near the bottom of the page and not currently loading
        if( $(window).scrollTop() + $(window).height() >= $(document).height() - 200 && !loading ) {
            loading = true;
            $('#loader').show(); // Show loader when starting to load posts

            $.ajax({
                url: infiniteScroll.ajax_url,
                type: 'POST',
                data: {
                    action: 'load_more_posts',
                    post_id: infiniteScroll.post_id,
                    cat_id: infiniteScroll.cat_id,
                    offset: offset
                },
                success: function(response) {
                    if(response.trim()) {
                        $('#post-container').append(response);
                        offset++;
                        loading = false;
                        $('#loader').hide(); // Hide loader after posts are loaded
                    } else {
                        $('#loader').hide(); // Hide loader if no more posts
                        // Optionally show a message when no more posts
                        if (!$('.no-more-posts').length) {
                            $('<p class="no-more-posts text-center">No more posts to load.</p>').appendTo('#post-container');
                        }
                    }
                }
            });
        }
    });
});

