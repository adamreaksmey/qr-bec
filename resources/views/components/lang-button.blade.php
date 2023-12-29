<button class="button is-warning" onclick="switchLanguage('{{ app()->getLocale() == 'kh' ? 'en' : 'kh' }}')">
    ខ្មែរ | English
</button>

<script>
    function switchLanguage(lang) {
        $.ajax({
            url: '/switch-lang',
            type: 'POST',
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                language: lang
            },
            success: function(response) {
                window.location.reload();
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }
</script>
