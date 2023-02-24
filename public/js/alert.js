const successMessage = "{{ session()->get('success') }}";

    if (successMessage) {
        toastr.success(successMessage)
    }