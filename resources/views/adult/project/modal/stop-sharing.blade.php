<!-- Stop Sharing Modal -->
<div class="modal fade" id="stopSharingModal" tabindex="-1" aria-labelledby="stopSharingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="stopSharingModalLabel">Stop Sharing Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to stop sharing this project?</p>
                <input type="hidden" id="stop_share_project_id">
                <input type="hidden" id="stop_share_user_id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="btnStopShare">Stop Sharing</button>
            </div>
        </div>
    </div>
</div> 