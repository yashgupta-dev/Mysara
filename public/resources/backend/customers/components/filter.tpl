
    <input type="hidden" name="is_filter" value="Y">
    <input type="hidden" name="dispatch" value="customers">

    <div class="form-group">
        <label for="cc-name">Name</label>
        <input type="text" name="name" id="cc-name" value="{$search.name}" class="form-control" autocomplete="off">
    </div>

    <div class="form-group">
        <label for="cc-email">Email</label>
        <input type="text" name="email" id="cc-email"  value="{$search.email}" class="form-control" autocomplete="off">
    </div>

    <div class="form-group">
        <label for="cc-phone">Phone</label>
        <input type="text" name="phone" id="cc-phone"  value="{$search.phone}" class="form-control" autocomplete="off">
    </div>

    <div class="form-group">
        <label for="cc-status">Status</label>
        <select name="status" class="form-control">
            <option value="A" {if $search.status == 'A'} selected {/if}>Active</option>
            <option value="D" {if $search.status == 'D'} selected {/if}>Disabled</option>
        </select>
    </div>

    <div class="form-group">
        <label for="cc-date">Date</label>
        <div class="row">
            <div class="col-md-6">
                <label for="cc-date">From</label>
                <input type="date" name="from" id="cc-date" class="form-control" autocomplete="off">
            </div>

            <div class="col-md-6">
                <label for="cc-date">To</label>
                <input type="date" name="to" id="cc-date" class="form-control" autocomplete="off">
            </div>
        </div>

    </div>
