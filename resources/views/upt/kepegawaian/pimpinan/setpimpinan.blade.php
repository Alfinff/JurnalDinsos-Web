<input type="hidden" name="id_unit_kerja" id="kode" value="{{$id_unit}}">
<input type="hidden" name="kode_unit_kerja" id="kdUnit" value="{{$unitkerja->kode_unit_kerja}}">
<div class="row">
	<div class="col-md-12">
		<div class="">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group row">
						<label class="col-sm-3 col-form-label" for="nama_unit">Nama Unit</label>
						<div class="col-sm-9">
							<input type="text" value="{{$unitkerja->nama_unit_kerja}}" name="nama_unit" id="nama_unit" class="form-control" readonly>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group row">
						<label for="kode_unit" class="col-sm-3 col-form-label">Kode Unit</label>
						<div class="col-sm-9">
							<input type="text" value="{{$unitkerja->kode_unit_kerja}}" name="kode_unit" class="form-control" id="kode_unit" readonly>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group row">
						<label for="users_id" class="col-sm-3 col-form-label">Nama Pimpinan</label>
						<div class="col-sm-9">
							<select required name="users_id" id="users_id" class="form-select">
								<option value="" selected disabled>Pilih Nama Pegawai</option>
								@foreach ($pegawai as $p)
									<option value="{{$p->uuid}}">{{ucwords($p->username)}}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>
			</div>
			{{-- <table>
				<tr class="row">
					<td class="col-md-12 row">
						<label for="" class="col-lg-2 col-form-label">Nama Unit</label>
						<div class="col-lg-10">
							<p>{{$unitkerja->nama_unit_kerja}}</p>
						</div>
					</td>
				</tr>
				<tr>
					<td>Kode Unit</td>
					<td>{{$unitkerja->kode_unit_kerja}}</td>
				</tr>
				<tr>
					<td>Nama Pimpinan</td>
					<td>
						<select name="users_id" id="users_id" class="form-select" required>
							<option value="" selected disabled>Pilih Nama Pegawai</option>
                            @foreach ($pegawai as $p)
                                <option value="{{$p->uuid}}">{{ucwords($p->username)}}</option>
                            @endforeach
						</select>
					</td>
				</tr>
			</table> --}}
		</div>
	</div>
</div>
