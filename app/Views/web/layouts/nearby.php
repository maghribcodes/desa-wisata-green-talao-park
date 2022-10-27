<!-- Check nearby -->
<div class="col-12" id="check-nearby-col">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title text-center">Facility Around</h5>
        </div>
        <div class="card-body">
            <div class="form-check">
                <div class="checkbox">
                    <input type="checkbox" id="check-cp" class="form-check-input" checked>
                    <label for="check-cp">Culinary Place</label>
                </div>
            </div>
            <div class="form-check">
                <div class="checkbox">
                    <input type="checkbox" id="check-ga" class="form-check-input">
                    <label for="check-ga">Gazebo</label>
                </div>
            </div>
            <div class="form-check">
                <div class="checkbox">
                    <input type="checkbox" id="check-of" class="form-check-input">
                    <label for="check-of">Outbond Field</label>
                </div>
            </div>
            <div class="form-check">
                <div class="checkbox">
                    <input type="checkbox" id="check-pa" class="form-check-input">
                    <label for="check-pa">Parking Area</label>
                </div>
            </div>
            <div class="form-check">
                <div class="checkbox">
                    <input type="checkbox" id="check-pb" class="form-check-input">
                    <label for="check-pb">Public Bathroom</label>
                </div>
            </div>
            <div class="form-check">
                <div class="checkbox">
                    <input type="checkbox" id="check-sa" class="form-check-input">
                    <label for="check-sa">Selfie Area</label>
                </div>
            </div>
            <div class="form-check">
                <div class="checkbox">
                    <input type="checkbox" id="check-sp" class="form-check-input">
                    <label for="check-sp">Souvenir Place</label>
                </div>
            </div>
            <div class="form-check">
                <div class="checkbox">
                    <input type="checkbox" id="check-th" class="form-check-input">
                    <label for="check-th">Tree House</label>
                </div>
            </div>
            <div class="form-check">
                <div class="checkbox">
                    <input type="checkbox" id="check-vt" class="form-check-input">
                    <label for="check-vt">Viewing Tower</label>
                </div>
            </div>
            <div class="form-check">
                <div class="checkbox">
                    <input type="checkbox" id="check-wp" class="form-check-input">
                    <label for="check-wp">Worship Place</label>
                </div>
            </div>
            <!-- <div class="mt-3">
                <label for="inputRadiusNearby" class="form-label">Radius: </label>
                <label id="radiusValueNearby" class="form-label">0 m</label>
                <input type="range" class="form-range" min="0" max="20" value="0" id="inputRadiusNearby" name="inputRadius" onchange="updateRadius('Nearby');">
            </div> -->
            <div class="mt-3">
                <a title="Search" class="btn icon btn-outline-primary mx-1" id="routeInfoWindow" onclick="showSteps()">
                    <i class="fa-brands fa-searchengin"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Search result nearby -->
<div class="col-12" id="result-nearby-col">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title text-center">Search Result Facility Around</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive overflow-auto" id="table-result-nearby">
                <table class="table table-hover mb-md-5 mb-3 table-lg" id="table-cp">
                </table>
                <table class="table table-hover mb-md-5 mb-3 table-lg" id="table-ga">
                </table>
                <table class="table table-hover mb-md-5 mb-3 table-lg" id="table-of">
                </table>
                <table class="table table-hover mb-md-5 mb-3 table-lg" id="table-pa">
                </table>
                <table class="table table-hover mb-md-5 mb-3 table-lg" id="table-pb">
                </table>
                <table class="table table-hover mb-md-5 mb-3 table-lg" id="table-sa">
                </table>
                <table class="table table-hover mb-md-5 mb-3 table-lg" id="table-sp">
                </table>
                <table class="table table-hover mb-md-5 mb-3 table-lg" id="table-th">
                </table>
                <table class="table table-hover mb-md-5 mb-3 table-lg" id="table-vt">
                </table>
                <table class="table table-hover mb-md-5 mb-3 table-lg" id="table-wp">
                </table>
            </div>
        </div>
    </div>
</div>