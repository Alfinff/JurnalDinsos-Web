<input type="hidden" name="uuid" id="uuid" value="{{$data->uuid}}">
<div class="row">
	<div class="col-md-12">
		<div class="">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group row">
						<label class="col-sm-3 col-form-label" for="nama_lengkap">Nama Lengkap</label>
						<div class="col-sm-9">
							<input type="text" value="{{$data->nama_lengkap}}" name="nama_lengkap" id="nama_lengkap" class="form-control" readonly>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group row">
						<label for="ttl" class="col-sm-3 col-form-label">Tempat, Tanggal Lahir</label>
						<div class="col-sm-9">
							<input type="text" value="{{ ucwords($data->tempat_lahir) .', '.date('d/m/Y', strtotime($data->tanggal_masuk)) }}" name="ttl" class="form-control" id="ttl" readonly>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group row">
						<label for="kondisi_terakhir" class="col-sm-3 col-form-label">Foto Kondisi Terakhir</label>
						<div class="col-sm-9">
							<input type="file" name="kondisi_terakhir" class="form-control" id="kondisi_terakhir" required title="Pilih Foto Kondisi Terakhir">
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group row">
						<label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
						<div class="col-sm-9">
							<textarea name="keterangan" class="form-control" id="keterangan"></textarea>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
