<input type="hidden" name="is_filter" value="Y">
<input type="hidden" name="dispatch" value="system.users">

<div class="form-group mb-3">
    <label for="cc-name">Name</label>
<input type="text" name="name" id="cc-name" value="{if !empty($search.name)}{$search.name}{/if}" class="form-control" autocomplete="off">
</div>

<div class="form-group mb-3">
    <label for="cc-email">Email</label>
    <input type="text" name="email" id="cc-email"  value="{if !empty($search.email)}{$search.email}{/if}" class="form-control" autocomplete="off">
</div>

<div class="form-group mb-3">
    <label for="cc-phone">Phone</label>
    <input type="text" name="phone" id="cc-phone"  value="{if !empty($search.phone)}{$search.phone}{/if}" class="form-control" autocomplete="off">
</div>

<div class="form-group mb-3">
    <label for="cc-status">Status</label>
    <select name="status" class="form-control">
        <option value="A" {if !empty($search.status) == 'A'} selected {/if}>Active</option>
        <option value="D" {if !empty($search.status) == 'D'} selected {/if}>Disabled</option>
    </select>
</div>

<div class="form-group mb-3">
    
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
