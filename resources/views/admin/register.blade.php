<x-layout>
    <div>Hello from register!</div>
    <div>Register user here:</div>
    <div>
        <div class="w-1/6">
            <div class="flex flex-col gap-2">
                <div class="flex flex-col gap-1">
                    <span>Name</span>
                    <input type="text" class="input name">
                </div>
            </div>
            <div class="flex flex-col gap-2">
                <div class="flex flex-col gap-1">
                    <span>Phone</span>
                    <input type="text" class="input phone">
                </div>
            </div>
        </div>
        <div class="alert-text"></div>
        <button type="button" class="button is-primary mt-10" id="registerButton">Register</button>
    </div>
    <div>
        <div>Reister relative</div>
        <div class="w-1/6">
            <div class="flex flex-col gap-2">
                <div class="flex flex-col gap-1">
                    <span>Parent ID</span>
                    <input type="text" class="input parentId">
                </div>
            </div>
            <div class="flex flex-col gap-2">
                <div class="flex flex-col gap-1">
                    <span>Name</span>
                    <input type="text" class="input relative-name">
                </div>
            </div>
        </div>
    </div>
    <div class="alert-text-relative"></div>
    <button type="button" class="button is-primary mt-10" id="registerRelative">Register relative</button>

</x-layout>
<script>
    $(document).ready(function() {
        $('#registerButton').click(function() {
            var name = $('.name').val();
            var phone = $('.phone').val();
            $.ajax({
                url: '/api/bec/register',
                type: 'POST',
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                data: {
                    name: name,
                    phone_number: phone.replace("'", ""),
                    password: '1234567890'
                },
                success: function(response) {
                    $('.alert-text').text(response.message + "parent id" + response.user.id)
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });

        $('#registerRelative').click(function() {
            var name = $('.relative-name').val();
            var parentId = $('.parentId').val();
            $.ajax({
                url: '/api/bec/create-relative',
                type: 'POST',
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                data: {
                    name: name,
                    parentId: parentId,
                },
                success: function(response) {
                    $('.alert-text-relative').text('Relative created!')
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>
