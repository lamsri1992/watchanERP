<table class="table table-borderless table-bordered">
    <tr>
        <th>วันที่ดำเนินการ</th>
        <td>{{ DateTimeThai($list->help_end) }}</td>
    </tr>
    <tr>
        <th>ผู้ดำเนินการ</th>
        <td>{{ $list->help_support }}</td>
    </tr>
    <tr>
        <th>สาเหตุ</th>
        <td>{{ $list->help_cause }}</td>
    </tr>
    <tr>
        <th>วิธีแก้ไข</th>
        <td>{{ $list->help_fix }}</td>
    </tr>
    <tr>
        <th>ประเภทปัญหา</th>
        <td>{{ $list->ht_name }}</td>
    </tr>
    <tr>
        <th>สถานะ</th>
        <td>
            <span class="{{ $list->hs_text }}">
                <i class="{{ $list->hs_icon }}"></i> {{ $list->hs_name }}
            </span>
        </td>
    </tr>
</table>