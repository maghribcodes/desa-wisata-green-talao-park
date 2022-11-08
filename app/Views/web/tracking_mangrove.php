<?= $this->extend('web/layouts/main'); ?>

<?= $this->section('content') ?>

<section class="section"">
    <div class=" row">
    <!--map-->
    <div class="col-md-8 col-12">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-md-auto">
                        <h5 class="card-title">Google Maps with Location</h5>
                    </div>
                    <?= $this->include('web/layouts/map-head'); ?>
                </div>
            </div>
            <?= $this->include('web/layouts/map-body-2'); ?>
        </div>
    </div>

    <div class="col-md-4 col-12">
        <div class="row">
            <!--Home-->
            <div class="col-12" id="list-at-col">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title text-center">Tracking Mangrove</h5>
                    </div>
                    <div class="card-body">
                        <script>
                            clearMarker();
                            clearRadius();
                            clearRoute();
                        </script>

                        <?php foreach ($data as $item) : ?>
                            <script>
                                objectMarker("<?= esc($item['id']); ?>", <?= esc($item['lat']); ?>, <?= esc($item['lng']); ?>);
                            </script>
                            <div class="row">
                                <div class="col table-responsive">
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <?= esc($item['description']); ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <!-- Object Media -->
                        <?= $this->include('web/layouts/our_gallery_video'); ?>

                    </div>
                </div>
            </div>
        </div>
        <!-- Nearby section -->
        <?= $this->include('web/layouts/track'); ?>
    </div>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    const myModal = document.getElementById('videoModal');
    const videoSrc = document.getElementById('video-play').getAttribute('data-src');

    myModal.addEventListener('shown.bs.modal', () => {
        console.log(videoSrc);
        document.getElementById('video').setAttribute('src', videoSrc);
    });
    myModal.addEventListener('hide.bs.modal', () => {
        document.getElementById('video').setAttribute('src', '');
    });

    $('#direction-row').hide();
    $('#check-track-col').hide();
    $('#check-nearby-col').hide();
    $('#result-track-col').hide();
    $('#result-nearby-col').hide();
</script>
<?= $this->endSection() ?>