<form id="fixFrm">
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
            <td>
                <input type="text" name="cause" class="form-control" value="{{ $list->help_cause }}" required>
            </td>
        </tr>
        <tr>
            <th>วิธีแก้ไข</th>
            <td>
                <input type="text" name="fix" class="form-control" value="{{ $list->help_fix }}" required>
            </td>
        </tr>
        <tr>
            <th>ประเภทปัญหา</th>
            <td>
                <select name="type" class="custom-select" required>
                    <option>เลือกประเภท</option>
                    @foreach ($type as $ts)
                    <option value="{{ $ts->ht_id }}"
                        @if ($list->help_type == $ts->ht_id)
                            {{ 'SELECTED' }}
                        @endif>
                        {{ $ts->ht_name }}
                    </option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <th>สถานะดำเนินการ</th>
            <td>
                <select name="stat" class="custom-select" required>
                    @foreach ($stat as $stats)
                    <option value="{{ $stats->hs_id }}"
                        @if ($list->help_status == $stats->hs_id)
                            {{ 'SELECTED' }}
                        @endif>
                        {{ $stats->hs_name }}
                    </option>
                    @endforeach
                </select>
            </td>
        </tr>
        @if ($list->help_status != 3)
        <tr>
            <td colspan="2" class="text-right">
                <button class="btn btn-sm btn-primary"><i class="fa fa-save"></i> บันทึกการซ่อม</button>
            </td>
        </tr>
        @endif
    </table>
</form>