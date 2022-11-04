<!DOCTYPE html>
<html lang="id">

<head>
    <title>Laporan Harian</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
</head>

<body>

    <div class="container">
        <br />
        <div class="small text-muted">Home » Results</div>
        <hr>
        <div class="col-md-12">
            <h5>Hasil Input Laporan Harian</h5>

            <div class="panel panel-body">
                Hi, data Anda berhasil diinput!<br /><br />

                <form id='telegramForm' method='POST'>
                    <input type='hidden' class='form-control' name='chat_id' id='telegram_id' value='1323480587'>
                    <input type='hidden' class='form-control' name='text' value='Waktu : <?php echo date("`Y-m-d H:i:s`"); ?> <?php echo "\n"; ?>Nama : * agung sidik <?php echo "*\n"; ?>Jumlah Penjualan : *5 <?php echo "*\n\n\n*>>>* _Laporan via bot Telegram_ *<<<*"; ?>'><br>

                    <button type="submit" id="sendToGroup" class="btn btn-primary">Posting ke Group</button>
                </form>

            </div>
        </div>
    </div>

    <script>
        $(document).on('click', '#sendToGroup', function(e) {
            SwalTelegram();
            e.preventDefault();
        });

        function SwalTelegram() {
            if ($("#telegram_id").val()) {
                swal({
                    title: 'Posting ke group?',
                    text: "Pastikan Laporan anda sudah benar",
                    type: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3FC3EE',
                    cancelButtonColor: '#E91E63',
                    confirmButtonText: 'Ya!',
                    showLoaderOnConfirm: true,

                    preConfirm: function() {
                        return new Promise(function(resolve) {
                            $.ajax({
                                    url: 'https://api.telegram.org/bot1323480587:AAE1XrAfZcW5qI5qT2naQw9Jup7mA-uXZhI/sendMessage?parse_mode=Markdown',
                                    type: 'POST',
                                    data: $('#telegramForm').serialize(),
                                    dataType: 'html'
                                })
                                .done(function(response) {
                                    swal({
                                        title: "Sukses!",
                                        html: "Silahkan laporan berhasil dikirim",
                                        type: "success",
                                        allowOutsideClick: false,
                                        timer: 5000,
                                        showConfirmButton: false,
                                        animation: false,
                                        customClass: 'animated jackInTheBox',
                                    })
                                })
                                .fail(function() {
                                    swal('Oops...', 'Ada kesalahan &#x2639;&#xfe0f;', 'error');
                                });
                        });
                    },
                    allowOutsideClick: false
                });
            } else {
                swal({
                    title: "Warning!",
                    html: "Ooops ada kesalahan system!",
                    type: "warning",
                    allowOutsideClick: false,
                    timer: 3000,
                    showConfirmButton: false
                });
            }
        }
    </script>
</body>

</html>