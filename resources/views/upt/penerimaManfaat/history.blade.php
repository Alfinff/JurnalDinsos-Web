@extends('layout.template')
@section('content')
<style>
    .head-dalem{
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: #F3F4F8;
      padding: 15px 15px 15px 15px;
      border-bottom: 1px solid #f3f4f8;
    }
    .head-dalem h5{
      font-size: 16px;
      font-weight: 400;
      color: #8890A7;
    }
    .head-dalem h5,.head-dalem p {
      margin: 0;
    }
    .accordion{
      overflow: hidden;
      padding: 3px;
    }
    .accordion h5{
      font-weight: 600;
    }
    .accordion-button{
      border-bottom: 1px solid #ddd;
      border-bottom-width: 1px !important; 
      font-size: 16px;
      font-weight: 400;
      color: #0c63e4;
      background-color: #e7f1ff;
      border-top-left-radius: 10px;
      border-top-right-radius: 10px;
      border: none;
    }
    .show{
      border: none;
    }
    .accordion-item:last-of-type .accordion-collapse{
      border-bottom-left-radius: 10px !important;
      border-bottom-right-radius: 10px !important;
    }
    .accordion-button.collapsed{
      border-radius: 10px !important;
    }
    .accordion-collapse{
      border-width: 1px !important;
    }
    .linestraight{
      position: relative;
      top: 25px;
      display: flex;
      flex-direction: column;
      align-items: center;
      height: 100%;
    }
    .plus{
      width: 20px;
      height: 20px;
      border-radius: 50%;
      font-size: 20px;
      border: 4px solid #CFE0FF;
      color: #b9bfca;
      display: flex;
      align-items: center;
      justify-content: center;
      background: #126AFC;
    }
    .dashed{
      border: 2px dashed #D6E5FF;
      height: calc(100% - 20px);
      width: 0;
    }
    @media only screen and (max-width: 600px) {
      .accordion-item{
        width: 100%;
      }
      .linestraight{
        margin-right: 10px
      }
    }
</style>
    <div class="col-md-10 bg-col">
        <div class="row">
            <div class="col-md-12 my-3">
                <div class="card">
                    <div class="card-card">
                      <div class="back">
                        <a href="https://jurnal-dinsos.primakom.co.id/upt/penerima" class="d-flex">
                          <img src="https://jurnal-dinsos.primakom.co.id//assets/images/back.png" alt="">
                          <p>Kembali</p>
                        </a>
                      </div>
                        <div class="head-judul text-center">
                            <h3>Historical</h3>
                        </div>
                        <hr>
                        <div class="accordion my-2" id="accordionExample3">
                          <h5>April 2021</h5>
                          <div class="d-flex">
                            <div class="col-md-1">
                              <div class="linestraight">
                                <div class="plus">
                                </div>
                                <div class="dashed"></div>
                              </div>
                            </div>
                            <div class="col-md-11 accordion-item my-2">
                              <h2 class="accordion-header" id="headingOne">
                              <button class="accordion-button shadow-sm" type="button" data-bs-toggle="collapse" data-bs-target="#april20211" aria-expanded="true" aria-controls="collapseOne">
                                + Tambah History
                              </button>
                              </h2>
                              <div id="april20211" class="shadow-sm accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                  <form action="#">
                                    <label for=""></label>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="accordion my-2" id="accordionExample3">
                          <h5>Maret 2021</h5>
                          <div class="d-flex">
                            <div class="col-md-1">
                              <div class="linestraight">
                                <div class="plus">
                                </div>
                                <div class="dashed"></div>
                              </div>
                            </div>
                            <div class="col-md-11 accordion-item my-2">
                              <h2 class="accordion-header" id="headingOne">
                              <button class="accordion-button shadow-sm collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#maret20211" aria-expanded="true" aria-controls="collapseOne">
                                3 Maret 2021
                              </button>
                              </h2>
                              <div id="maret20211" class="shadow-sm accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                  <strong>This is the first item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                              </div>
                              </div>
                            </div>
                            <div class="d-flex">
                              <div class="col-md-1">
                                <div class="linestraight">
                                  <div class="plus">
                                  </div>
                                <div class="dashed"></div>
                                </div>
                              </div>
                              <div class="col-md-11 accordion-item my-2">
                                <h2 class="accordion-header" id="headingTwo">
                                <button class="shadow-sm accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#maret20212" aria-expanded="false" aria-controls="collapseTwo">
                                  22 Maret 2021
                                </button>
                              </h2>
                              <div id="maret20212" class="shadow-sm accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                  <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="accordion my-2" id="accordionExample2">
                            <h5>Februari 2021</h5>
                            <div class="d-flex">
                                <div class="col-md-1">
                                    <div class="linestraight">
                                        <div class="plus">
                                        </div>
                                        <div class="dashed"></div>
                                    </div>
                                </div>
                                <div class="col-md-11 accordion-item my-2">
                                  <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button shadow-sm collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#februari20211" aria-expanded="true" aria-controls="collapseOne">
                                      1 Februari 2021
                                    </button>
                                  </h2>
                                  <div id="februari20211" class="shadow-sm accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                      <strong>This is the first item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-1">
                                    <div class="linestraight">
                                        <div class="plus">
                                        </div>
                                        <div class="dashed"></div>
                                    </div>
                                </div>
                                <div class="col-md-11 accordion-item my-2">
                                  <h2 class="accordion-header" id="headingTwo">
                                    <button class="shadow-sm accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#februari20212" aria-expanded="false" aria-controls="collapseTwo">
                                      25 Februari 2021
                                    </button>
                                  </h2>
                                  <div id="februari20212" class="shadow-sm accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                      <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-1">
                                    <div class="linestraight">
                                        <div class="plus">
                                        </div>
                                        <div class="dashed"></div>
                                    </div>
                                </div>
                                <div class="col-md-11 accordion-item my-2">
                                  <h2 class="accordion-header" id="headingThree">
                                    <button class="shadow-sm accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#februari20213" aria-expanded="false" aria-controls="collapseThree">
                                      28 Februari 2021
                                    </button>
                                  </h2>
                                  <div id="februari20213" class="shadow-sm accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                      <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion my-2" id="accordionExample">
                            <h5>Januari 2021</h5>
                            <div class="d-flex">
                                <div class="col-md-1">
                                    <div class="linestraight">
                                        <div class="plus">
                                        </div>
                                        <div class="dashed"></div>
                                    </div>
                                </div>
                                <div class="col-md-11 accordion-item my-2">
                                  <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button shadow-sm collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#januari20211" aria-expanded="true" aria-controls="collapseOne">
                                      5 Januari 2021
                                    </button>
                                  </h2>
                                  <div id="januari20211" class="shadow-sm accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                      <strong>This is the first item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-1">
                                    <div class="linestraight">
                                        <div class="plus">
                                        </div>
                                        <div class="dashed"></div>
                                    </div>
                                </div>
                                <div class="col-md-11 accordion-item my-2">
                                  <h2 class="accordion-header" id="headingTwo">
                                    <button class="shadow-sm accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#januari20212" aria-expanded="false" aria-controls="collapseTwo">
                                      20 Januari 2021
                                    </button>
                                  </h2>
                                  <div id="januari20212" class="shadow-sm accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                      <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-1">
                                    <div class="linestraight">
                                        <div class="plus">
                                        </div>
                                        <div class="dashed"></div>
                                    </div>
                                </div>
                                <div class="col-md-11 accordion-item my-2">
                                  <h2 class="accordion-header" id="headingThree">
                                    <button class="shadow-sm accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#januari20213" aria-expanded="false" aria-controls="collapseThree">
                                      29 Januari 2021
                                    </button>
                                  </h2>
                                  <div id="januari20213" class="shadow-sm accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                      <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection