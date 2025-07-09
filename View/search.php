<div class="col-12" id="layout">
    <div class="row row-cols-1 g-3" id="results">
        <!-- Results will be injected here -->
    </div>
</div>
<script>
    $(document).ready(function(){
        $.ajax({
            url: '/api/search/query?query=<?= $this->Request->getParams('GET', 'query') ?>',
            type: 'GET',dataType: 'json',
            error: function(xhr, status, error) {
                let color = 'info', icon = 'question-circle', title = builder.Locale.get(xhr.statusText), content = builder.Locale.get(xhr.responseText);
                switch(xhr.status){
                    case 403: color = 'danger'; icon = 'shield-lock'; break;
                    case 404: color = 'warning'; icon = 'question-diamond'; break;
                    case 500: color = 'danger'; icon = 'bug'; break;
                }
                builder.Component("alert","#layout",{icon:icon,color:color,title:title},function(alert,component){component.content.html('<pre class="m-0 p-2">'+content+'</pre>');});
            },
            success: function(response) {
                console.log(response);

                // Add results to the layout
                for(const [key, index] of Object.entries(response)){

                    // Render the result
                    var result = $(SearchRenderer("<?= $this->Request->getParams('GET', 'query') ?>", index)).appendTo("#results");

                    // Add hover effect
                    result.hover(function() {
                        $(this).addClass("text-bg-secondary");
                    }, function() {
                        $(this).removeClass("text-bg-secondary");
                    });

                    // Add click event
                    result.click(function() {

                        // Redirect to the index
                        window.location.href = `${index.route.route}${index.segments}`;
                    });
                }
            },
        });
    });
</script>
