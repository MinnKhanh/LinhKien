$("document").ready(function () {
     $(".select2-box").select2({
        width: 'resolve'
    });
    initDatePicker();
    initDatePickerNow();
    initDateLocalPicker();
    window.addEventListener('setDateForDatePicker', e => {
        initDatePicker();
    })
    window.livewire.on('setDatePicker', () => {
        initDatePicker()
    })
    window.livewire.on('resetDateKendo', () => {
        document.getElementById('fromDate').value = '';
        document.getElementById('toDate').value = '';
    })
    window.livewire.on('resetDateRangerKendo', () => {
        document.getElementById('transactionDate').value = '';
    })
    window.addEventListener('show-toast', event => {
        let type = event.detail.type;
        let message = event.detail.message;
        Swal.fire({
            title: message,
            icon: type,
            confirmButtonText: 'OK',
            showCancelButton: false,
            showCloseButton: true
        });
        return;
    });
    window.addEventListener('alert', event => {
        let type = event.detail.type;
        switch (type) {
            case "success":
                toastr.success(event.detail.message);
                break;
            case "error":
                toastr.error(event.detail.message);
                break;
            case "warning":
                toastr.warning(event.detail.message);
                break;
            case "info":
                toastr.info(event.detail.message);
                break;
            default:
                toastr.info(event.detail.message);
                break;
        }
    });

    window.addEventListener('setDatePickerNow', event => {
        let id = $('#buyDate').attr('id');
        $('#buyDate').kendoDatePicker({
            format: 'dd/MM/yyyy',
            type: 'number',
            change: function () {
                if (this.value() != null) {
                    window.livewire.emit('set' + id, {
                        [id]: this.value() ? this.value().toLocaleDateString('en-US') : null
                    });
                }

            }
        });
    });
    window.addEventListener('setDateLocalPickerNow', event => {
        let id = $('#transactionDate').attr('id');
        alert(id);
        $('#transactionDate').kendoDateTimePicker({
            format: 'dd/MM/yyyy HH:mm tt',
            type: 'number',
            max: new Date(),
            change: function () {
                if (this.value() != null) {
                    window.livewire.emit('set' + id, {
                        ['transactionDate']: this.value() ? this.value().toLocaleString('en-US') : null
                    });
                }
            }
        });
    });
})