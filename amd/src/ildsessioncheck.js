define(['jquery', 'core/ajax', 'core/modal_factory'], function ($, ajax, ModalFactory) {
    function poll_status() {
        var interval = setInterval(function () {
            var promises = ajax.call([
                {methodname: 'local_ildsessioncheck_check_session', args: {}}
            ]);

            promises[0].done(function (response) {
                if (response.status == 0) {
                    var trigger = $('');
                    ModalFactory.create({
                        title: 'Sitzung abgelaufen',
                        body: '<p>Ihre Sitzung ist abgelaufen, bitte melden Sie sich erneut im System an.'
                        + 'Wenn Sie das Lernpaket weiter bearbeiten, wird Ihr Fortschritt '
                        + '<strong>nicht</strong> festgehalten.</p>',
                    }, trigger)
                        .done(function (modal) {
                            modal.show();
                        });

                    clearInterval(interval);
                }
            }).fail(function () {
                var trigger = $('');
                ModalFactory.create({
                    title: 'Sitzung abgelaufen',
                    body: '<p>Ihre Sitzung ist abgelaufen, bitte melden Sie sich erneut im System an.'
                    + 'Wenn Sie das Lernpaket weiter bearbeiten, wird Ihr Fortschritt '
                    + '<strong>nicht</strong> festgehalten.</p>',
                }, trigger)
                    .done(function (modal) {
                        modal.show();
                    });

                clearInterval(interval);
            });
        }, 30000);
    }

    return {
        init: function () {
            poll_status();

            $(window).on('beforeunload', function () {
                ModalFactory.create({
                    title: 'Reload',
                    body: '<p>Wenn Sie die Website neuladen, werden bisher erzielte Ergebnisse überschrieben! '
                    + 'Möchten Sie die Website trotzdem neuladen?</p>',
                }, trigger)
                    .done(function (modal) {
                        modal.show();
                    });
            });
        }
    };
});
