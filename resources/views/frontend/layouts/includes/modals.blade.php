 <!-- User Modal -->
 <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content p-4">
             <div class="modal-header border-0">
                 <h5 class="modal-title fs-3 fw-bold" id="userModalLabel">Sign Up</h5>

                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <form class="needs-validation" novalidate>
                     <div class="mb-3">
                         <label for="fullName" class="form-label">Name</label>
                         <input type="text" class="form-control" id="fullName" placeholder="Enter Your Name"
                             required />
                         <div class="invalid-feedback">Please enter name.</div>
                     </div>
                     <div class="mb-3">
                         <label for="email" class="form-label">Email address</label>
                         <input type="email" class="form-control" id="email" placeholder="Enter Email address"
                             required />
                         <div class="invalid-feedback">Please enter email.</div>
                     </div>
                     <div class="mb-3">
                         <label for="password" class="form-label">Password</label>
                         <input type="password" class="form-control" id="password" placeholder="Enter Password"
                             required />
                         <div class="invalid-feedback">Please enter password.</div>
                         <small class="form-text">
                             By Signup, you agree to our
                             <a href="#!">Terms of Service</a>
                             &
                             <a href="#!">Privacy Policy</a>
                         </small>
                     </div>

                     <button type="submit" class="btn btn-primary" type="submit">Sign Up</button>
                 </form>
             </div>
             <div class="modal-footer border-0 justify-content-center">
                 Already have an account?
                 <a href="#">Sign in</a>
             </div>
         </div>
     </div>
 </div>


 <!-- Location Modal -->
 <div class="modal fade" id="locationModal" tabindex="-1" aria-labelledby="locationModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-sm modal-dialog-centered">
         <div class="modal-content">
             <div class="modal-body p-6">
                 <div class="d-flex justify-content-between align-items-start">
                     <div>
                         <h5 class="mb-1" id="locationModalLabel">Choose your Delivery Location</h5>
                         <p class="mb-0 small">Enter your address and we will specify the offer you area.</p>
                     </div>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                 <div class="my-5">
                     <input type="search" class="form-control" placeholder="Search your area" />
                 </div>
                 <div class="d-flex justify-content-between align-items-center mb-2">
                     <h6 class="mb-0">Select Location</h6>
                     <a href="#" class="btn btn-outline-gray-400 text-muted btn-sm">Clear All</a>
                 </div>
                 <div>
                     <div data-simplebar style="height: 300px">
                         <div class="list-group list-group-flush">
                             <a href="#"
                                 class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action active">
                                 <span>Alabama</span>
                                 <span>Min:$20</span>
                             </a>
                             <a href="#"
                                 class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">
                                 <span>Alaska</span>
                                 <span>Min:$30</span>
                             </a>
                             <a href="#"
                                 class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">
                                 <span>Arizona</span>
                                 <span>Min:$50</span>
                             </a>
                             <a href="#"
                                 class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">
                                 <span>California</span>
                                 <span>Min:$29</span>
                             </a>
                             <a href="#"
                                 class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">
                                 <span>Colorado</span>
                                 <span>Min:$80</span>
                             </a>
                             <a href="#"
                                 class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">
                                 <span>Florida</span>
                                 <span>Min:$90</span>
                             </a>
                             <a href="#"
                                 class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">
                                 <span>Arizona</span>
                                 <span>Min:$50</span>
                             </a>
                             <a href="#"
                                 class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">
                                 <span>California</span>
                                 <span>Min:$29</span>
                             </a>
                             <a href="#"
                                 class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">
                                 <span>Colorado</span>
                                 <span>Min:$80</span>
                             </a>
                             <a href="#"
                                 class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">
                                 <span>Florida</span>
                                 <span>Min:$90</span>
                             </a>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>


 <!--- Search Modal -->
 <div class="modal fade" id="SearchModal" tabindex="-1" aria-labelledby="SearchModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-sm modal-dialog-centered">
         <div class="modal-content">
             <div class="modal-body p-6">
                 <div class="d-flex justify-content-between align-items-start">
                     <div>
                         <h5 class="mb-1" id="locationModalLabel">Search for Products</h5>
                     </div>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                 <div class="my-5">
                     <form action="{{ route('products.search') }}" method="GET">
                         <div class="input-group">
                             <input name="query" class="form-control rounded" type="search"
                                    placeholder="Search for products" value="{{ old('query', $query ?? '') }}" />
                             <span class="input-group-append">
                                  <button class="btn bg-white border border-start-0 ms-n10 rounded-0 rounded-end"
                                          type="submit">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                           viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                           stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                                          <circle cx="11" cy="11" r="8"></circle>
                                          <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                      </svg>
                                  </button>
                              </span>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     </div>
 </div>
