<!-- Rate Modal -->
<div class="modal fade" id="rateModal" tabindex="-1" role="dialog" aria-labelledby="rateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="rateModalLabel"><i class="fa fa-clipboard-check"></i> แบบประเมินความพึงพอใจ</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @if (!isset($list->rate_id))
        <form id="rateFrm">
            <div class="modal-body">
                <table class="table table-sm table-bordered">
                    <tr class="text-center">
                        <th width="75%">รายการ / คะแนน <i class="far fa-smile"></i></th>
                        <th width="5%">5</th>
                        <th width="5%">4</th>
                        <th width="5%">3</th>
                        <th width="5%">2</th>
                        <th width="5%">1</th>
                    </tr>
                    <tr>
                        <td>1. ความรวดเร็วในการให้บริการ</td>
                        <td class="text-center"><input type="radio" id="rate_1" name="rate_1" value="5"></td>
                        <td class="text-center"><input type="radio" id="rate_1" name="rate_1" value="4"></td>
                        <td class="text-center"><input type="radio" id="rate_1" name="rate_1" value="3"></td>
                        <td class="text-center"><input type="radio" id="rate_1" name="rate_1" value="2"></td>
                        <td class="text-center"><input type="radio" id="rate_1" name="rate_1" value="1"></td>
                    </tr>
                    <tr>
                        <td>2. การจัดลำดับขั้นตอนการให้บริการ</td>
                        <td class="text-center"><input type="radio" id="rate_2" name="rate_2" value="5"></td>
                        <td class="text-center"><input type="radio" id="rate_2" name="rate_2" value="4"></td>
                        <td class="text-center"><input type="radio" id="rate_2" name="rate_2" value="3"></td>
                        <td class="text-center"><input type="radio" id="rate_2" name="rate_2" value="2"></td>
                        <td class="text-center"><input type="radio" id="rate_2" name="rate_2" value="1"></td>
                    </tr>
                    <tr>
                        <td>3. ความเต็มใจและความพร้อมในการให้บริการ</td>
                        <td class="text-center"><input type="radio" id="rate_3" name="rate_3" value="5"></td>
                        <td class="text-center"><input type="radio" id="rate_3" name="rate_3" value="4"></td>
                        <td class="text-center"><input type="radio" id="rate_3" name="rate_3" value="3"></td>
                        <td class="text-center"><input type="radio" id="rate_3" name="rate_3" value="2"></td>
                        <td class="text-center"><input type="radio" id="rate_3" name="rate_3" value="1"></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">ปิดหน้าต่าง</button>
                <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-check-circle"></i> ส่งแบบประเมิน</button>
            </div>
        </form>
        @else
        <div class="modal-body">
            <table class="table table-sm table-bordered">
                <tr class="">
                    <th>รายการประเมิน</th>
                    <th class="text-center">คะแนน <i class="far fa-smile"></i></th>
                </tr>
                <tr>
                    <td>1. ความรวดเร็วในการให้บริการ</td>
                    <td class="text-center">{{ $list->rate_1 }}</td>
                </tr>
                <tr>
                    <td>2. การจัดลำดับขั้นตอนการให้บริการ</td>
                    <td class="text-center">{{ $list->rate_2 }}</td>
                <tr>
                    <td>3. ความเต็มใจและความพร้อมในการให้บริการ</td>
                    <td class="text-center">{{ $list->rate_3 }}</td>
                </tr>
                <tr>
                    @php $rate_all = ($list->rate_1 + $list->rate_2 + $list->rate_3)@endphp
                    <td colspan="2" class="text-center" data-toggle="tooltip" data-placement="bottom" title="{{ $rate_all }} คะแนน">
                        <p>{{ $list->rate_user }}</p>
                        <p>{{ DateTimeThai($list->rate_date) }}</p>
                        @php
                            $rate = $rate_all / 3;
                            $i = 1; while ($i <= $rate) { 
                                echo "<p class='fa fa-star text-yellow'></p>";$i++; 
                            }
                        @endphp
                    </td>
                </tr>
            </table>
        </div>
        @endif
    </div>
</div>