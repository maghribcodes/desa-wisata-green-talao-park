<!-- Check nearby -->
<div class="col-12" id="check-nearby-col">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title text-center">Object Around</h5>
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
                    <input type="checkbox" id="check-ev" class="form-check-input">
                    <label for="check-cp">Event</label>
                </div>
            </div>
            <div class="form-check">
                <div class="checkbox">
                    <input type="checkbox" id="check-gp" class="form-check-input">
                    <label for="check-cp">Government Place</label>
                </div>
            </div>
            <div class="form-check">
                <div class="checkbox">
                    <input type="checkbox" id="check-ho" class="form-check-input">
                    <label for="check-cp">Homestay</label>
                </div>
            </div>
            <div class="form-check">
                <div class="checkbox">
                    <input type="checkbox" id="check-wp" class="form-check-input">
                    <label for="check-cp">Souvenir Place</label>
                </div>
            </div>
            <div class="form-check">
                <div class="checkbox">
                    <input type="checkbox" id="check-sp" class="form-check-input">
                    <label for="check-cp">Worship Place</label>
                </div>
            </div>
            <div class="mt-3">
                <label for="inputRadiusNearby" class="form-label">Radius: </label>
                <label id="radiusValueNearby" class="form-label">0 m</label>
                <input type="range" class="form-range" min="0" max="20" value="0" id="inputRadiusNearby" name="inputRadius" onchange="updateRadius('Nearby');">
            </div>
        </div>
    </div>
</div>

<!-- Search result nearby -->
<div class="col-12" id="result-nearby-col">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title text-center">Search Result Object Around</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive overflow-auto" id="table-result-nearby">
                <table class="table table-hover mb-md-5 mb-3 table-lg" id="table-cp">
                </table>
                <table class="table table-hover mb-md-5 mb-3 table-lg" id="table-ev">
                </table>
                <table class="table table-hover mb-md-5 mb-3 table-lg" id="table-gp">
                </table>
                <table class="table table-hover mb-md-5 mb-3 table-lg" id="table-ho">
                </table>
                <table class="table table-hover mb-md-5 mb-3 table-lg" id="table-sp">
                </table>
                <table class="table table-hover mb-md-5 mb-3 table-lg" id="table-wp">
                </table>
            </div>
        </div>
    </div>
</div>