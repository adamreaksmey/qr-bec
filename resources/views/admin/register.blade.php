<x-layout>
    <div class="flex flex-col gap-10">

        <div>
            <div class="text-lg font-bold">Register new user here:</div>
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
            <button type="button" class="button is-primary mt-3" id="registerButton">Register</button>
        </div>
        <div>
            <div class="text-lg font-bold">Reister relative here:</div>
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
            <div class="alert-text-relative"></div>
            <button type="button" class="button is-primary mt-3" id="registerRelative">Register relative</button>
        </div>
    </div>
    <div class="pt-5 w-1/4 flex flex-col gap-10">
        <p> <span class="text-lg font-bold underline">Instruction:</span> The relative can be created by using a parent
            id. a parent id can either be
            obtained from the
            dashboard or from a recently created a user. When a user is created, it will log message somewhere below the
            form telling you the user is created with a parent of bla bla... you can then use that id to create a
            relative that will be associated with a user with that id.</p>
        <p>If user already exists, and you wanna add one of their members, just go to the dashboard and obtain their id
            and create them here.</p>
    </div>

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
                    $('.alert-text').empty();
                    $('.alert-text').html(
                        `
                        <span>
                            User has been created with a parent id of <span style="color: red">${response.user.id}</span> !
                        </span>
                        `
                    )
                },
                error: function(xhr, status, error) {
                    $('.alert-text').empty();
                    $('.alert-text').html(
                        `
                        <span>
                            User has been created with a parent id of <span style="color: red">${xhr.responseText}</span> !
                        </span>
                        `
                    )

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
