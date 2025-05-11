{assign var="period" value=$period|default:""}
<div class="form-">
    <div class="form-group ty-period__wrapper">
        {* <label class="ty-control-group__title">{__("period")}</label> *}
        <select class="ty-period__select form-control" name="filters[{$field_name}][period]" id="period_selects">
            <option value="A" {if $period == "A" || !$period}selected="selected"{/if}>{$lang.all}</option>
            <optgroup label="=============">
                <option value="D" {if $period == "D"}selected="selected"{/if}>{$lang.this_day}</option>
                <option value="W" {if $period == "W"}selected="selected"{/if}>{$lang.this_week}</option>
                <option value="M" {if $period == "M"}selected="selected"{/if}>{$lang.this_month}</option>
                <option value="Y" {if $period == "Y"}selected="selected"{/if}>{$lang.this_year}</option>
            </optgroup>
            <optgroup label="=============">
                <option value="LD" {if $period == "LD"}selected="selected"{/if}>{$lang.yesterday}</option>
                <option value="LW" {if $period == "LW"}selected="selected"{/if}>{$lang.previous_week}</option>
                <option value="LM" {if $period == "LM"}selected="selected"{/if}>{$lang.previous_month}</option>
                <option value="LY" {if $period == "LY"}selected="selected"{/if}>{$lang.previous_year}</option>
            </optgroup>
            <optgroup label="=============">
                <option value="HH" {if $period == "HH"}selected="selected"{/if}>{$lang.last_24hours}</option>
                {* <option value="HW" {if $period == "HW"}selected="selected"{/if}>{$lang.last_n_days ["[N]" => 7])}</option>
                <option value="HM" {if $period == "HM"}selected="selected"{/if}>{$lang.last_n_days ["[N]" => 30])}</option> *}
            </optgroup>
            <optgroup label="=============">
                <option value="C" {if $period == "C"}selected="selected"{/if}>{$lang.custom}</option>
            </optgroup>
        </select>
    </div>

    <div class="form-group ty-period__select-date calendar">
        <label class="ty-control-group__title">Select Dates</label>
        <input type="date" class="form-control" name="filters[{$field_name}][time_from]" id="f_date" value="{if !empty($filter_value.time_from)}{$filter_value.time_from}{/if}" onchange="document.getElementById('period_selects').value='C'" />
        <span class="ty-period__dash">&#8211;</span>
        <input type="date" class="form-control" name="filters[{$field_name}][time_to]" id="t_date" value="{if !empty($filter_value.time_to)}{$filter_value.time_to}{/if}" onchange="document.getElementById('period_selects').value='C'" />
    </div>

    <script>
    document.getElementById('period_selects').addEventListener('change', function () {
        var from = document.getElementById('f_date');
        var to = document.getElementById('t_date');
        var today = new Date();
    
        function pad(n) {
            return n < 10 ? '0' + n : n;
        }
    
        function format(d) {
            return d.getFullYear() + '-' + pad(d.getMonth() + 1) + '-' + pad(d.getDate());
        }
    
        var fromDate = null;
        var toDate = null;
        var selected = this.value;
    
        if (selected === 'D') {
            fromDate = new Date(today);
            toDate = new Date(today);
        } else if (selected === 'W') {
            fromDate = new Date(today);
            fromDate.setDate(today.getDate() - today.getDay());
            toDate = new Date(today);
        } else if (selected === 'M') {
            fromDate = new Date(today.getFullYear(), today.getMonth(), 1);
            toDate = new Date(today);
        } else if (selected === 'Y') {
            fromDate = new Date(today.getFullYear(), 0, 1);
            toDate = new Date(today);
        } else if (selected === 'LD') {
            fromDate = new Date(today);
            fromDate.setDate(fromDate.getDate() - 1);
            toDate = new Date(fromDate);
        } else if (selected === 'LW') {
            fromDate = new Date(today);
            fromDate.setDate(fromDate.getDate() - fromDate.getDay() - 7);
            toDate = new Date(fromDate);
            toDate.setDate(toDate.getDate() + 6);
        } else if (selected === 'LM') {
            fromDate = new Date(today.getFullYear(), today.getMonth() - 1, 1);
            toDate = new Date(today.getFullYear(), today.getMonth(), 0);
        } else if (selected === 'LY') {
            fromDate = new Date(today.getFullYear() - 1, 0, 1);
            toDate = new Date(today.getFullYear() - 1, 11, 31);
        } else if (selected === 'HH') {
            fromDate = new Date(today.getTime() - 24 * 60 * 60 * 1000);
            toDate = new Date(today);
        } else if (selected === 'A') {
            from.value = '';
            to.value = '';
            return;
        } else if (selected === 'C') {
            from.value = '';
            to.value = '';
            return;
        } else {
            return;
        }
    
        from.value = format(fromDate);
        to.value = format(toDate);
    });
    </script>
</div>
