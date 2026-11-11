<div class="row g-4">
    
    <!-- LEFT COLUMN: CUSTOMER & QUOTATION META -->
    <div class="col-lg-4">
        
        <!-- 1. Customer Selection Card -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                <h5 class="card-title text-dark mb-0 fs-6 fw-bold">
                    <i class="bi bi-person-circle text-primary me-2"></i> Customer Selection
                </h5>
                <span class="badge bg-light text-primary border">Required</span>
            </div>
            <div class="card-body">
                
                @if(!empty($selectedOrder))
                    <div class="alert alert-info py-2 px-3 small d-flex align-items-center gap-2 mb-3">
                        <i class="bi bi-info-circle-fill fs-5"></i>
                        <div>
                            Linked to Order / Inquiry <strong>#{{ $selectedOrder->id }}</strong>. Details pre-filled automatically.
                        </div>
                    </div>
                @endif

                <!-- User Mode Switcher -->
                <div class="btn-group w-100 mb-3" role="group">
                    <input type="radio" class="btn-check" name="user_mode" id="mode_existing" value="existing" autocomplete="off" checked>
                    <label class="btn btn-outline-primary btn-sm" for="mode_existing">
                        <i class="bi bi-search me-1"></i> Select Registered User
                    </label>

                    <input type="radio" class="btn-check" name="user_mode" id="mode_new" value="new" autocomplete="off">
                    <label class="btn btn-outline-primary btn-sm" for="mode_new">
                        <i class="bi bi-person-plus me-1"></i> New Customer
                    </label>
                </div>

                <!-- Existing User Dropdown -->
                <div id="section_existing_user" class="mb-3">
                    <label class="form-label small fw-bold">Search &amp; Select Customer</label>
                    <select class="form-select select2-user" id="user_select" name="user_id">
                        <option value="">-- Choose existing user or type --</option>
                        @foreach($users as $usr)
                            @php
                                $uName = $usr->name ?: trim(($usr->first_name ?? '') . ' ' . ($usr->last_name ?? ''));
                            @endphp
                            <option value="{{ $usr->id }}" 
                                    data-name="{{ $uName }}"
                                    data-email="{{ $usr->email }}"
                                    data-phone="{{ $usr->phone }}"
                                    data-company="{{ $usr->about ?? '' }}"
                                    {{ (old('user_id', $quotation->user_id ?? $prefilledData['user_id'] ?? '') == $usr->id) ? 'selected' : '' }}>
                                {{ $uName }} ({{ $usr->email }})
                            </option>
                        @endforeach
                    </select>
                    <div class="form-text small">Select an existing customer to auto-fill their info.</div>
                </div>

                <hr class="my-3 text-muted opacity-25">

                <!-- Customer Fields -->
                <div class="mb-3">
                    <label class="form-label small fw-bold">Customer Full Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="customer_name" name="customer_name" required 
                           value="{{ old('customer_name', $quotation->customer_name ?? $prefilledData['customer_name'] ?? '') }}"
                           placeholder="e.g. Johnathan Davis">
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold">Email Address <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="customer_email" name="customer_email" required 
                           value="{{ old('customer_email', $quotation->customer_email ?? $prefilledData['customer_email'] ?? '') }}"
                           placeholder="e.g. john@globalfurniture.com">
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold">Phone / WhatsApp Number</label>
                    <input type="tel" class="form-control" id="customer_phone" name="customer_phone" 
                           value="{{ old('customer_phone', $quotation->customer_phone ?? $prefilledData['customer_phone'] ?? '') }}"
                           placeholder="e.g. +1 555 123 4567">
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold">Company / Business Name</label>
                    <input type="text" class="form-control" id="customer_company" name="customer_company" 
                           value="{{ old('customer_company', $quotation->customer_company ?? $prefilledData['customer_company'] ?? '') }}"
                           placeholder="e.g. Nordic Haven Imports Ltd.">
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold">Delivery Address / Destination Port</label>
                    <textarea class="form-control" id="customer_address" name="customer_address" rows="2" 
                              placeholder="e.g. 144 Ocean Boulevard, Long Beach Port, California, USA">{{ old('customer_address', $quotation->customer_address ?? $prefilledData['customer_address'] ?? '') }}</textarea>
                </div>

                <div class="form-check form-switch mt-2" id="create_user_switch_wrap">
                    <input class="form-check-input" type="checkbox" id="create_new_user" name="create_new_user" value="1">
                    <label class="form-check-label small" for="create_new_user">
                        Save as registered user in database
                    </label>
                </div>

            </div>
        </div>

        <!-- 2. Quotation Settings Card -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="card-title text-dark mb-0 fs-6 fw-bold">
                    <i class="bi bi-gear-wide-connected text-primary me-2"></i> Quotation Metadata
                </h5>
            </div>
            <div class="card-body">
                
                <input type="hidden" name="order_id" value="{{ old('order_id', $quotation->order_id ?? $prefilledData['order_id'] ?? '') }}">

                <div class="mb-3">
                    <label class="form-label small fw-bold">Quotation Reference # <span class="text-danger">*</span></label>
                    <input type="text" class="form-control font-monospace fw-bold text-primary" name="quotation_no" required 
                           value="{{ old('quotation_no', $quotation->quotation_no ?? $prefilledData['quotation_no'] ?? '') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold">Quotation Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="title" required 
                           value="{{ old('title', $quotation->title ?? $prefilledData['title'] ?? 'Commercial Export Furniture Quotation') }}">
                </div>

                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <label class="form-label small fw-bold">Issue Date</label>
                        <input type="date" class="form-control" name="date" required 
                               value="{{ old('date', isset($quotation->date) ? $quotation->date->format('Y-m-d') : ($prefilledData['date'] ?? date('Y-m-d'))) }}">
                    </div>
                    <div class="col-6">
                        <label class="form-label small fw-bold">Valid Until</label>
                        <input type="date" class="form-control" name="valid_until" 
                               value="{{ old('valid_until', isset($quotation->valid_until) ? $quotation->valid_until->format('Y-m-d') : ($prefilledData['valid_until'] ?? date('Y-m-d', strtotime('+30 days')))) }}">
                    </div>
                </div>

                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <label class="form-label small fw-bold">Status</label>
                        <select name="status" class="form-select">
                            <option value="draft" {{ old('status', $quotation->status ?? '') === 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="sent" {{ old('status', $quotation->status ?? '') === 'sent' ? 'selected' : '' }}>Sent to Client</option>
                            <option value="approved" {{ old('status', $quotation->status ?? '') === 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ old('status', $quotation->status ?? '') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <label class="form-label small fw-bold">Currency</label>
                        <select name="currency" class="form-select">
                            <option value="USD" {{ old('currency', $quotation->currency ?? 'USD') === 'USD' ? 'selected' : '' }}>USD ($)</option>
                            <option value="EUR" {{ old('currency', $quotation->currency ?? '') === 'EUR' ? 'selected' : '' }}>EUR (€)</option>
                            <option value="GBP" {{ old('currency', $quotation->currency ?? '') === 'GBP' ? 'selected' : '' }}>GBP (£)</option>
                            <option value="INR" {{ old('currency', $quotation->currency ?? '') === 'INR' ? 'selected' : '' }}>INR (₹)</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold">Origin Company / Brand</label>
                    <input type="text" class="form-control" name="company_name" required 
                           value="{{ old('company_name', $quotation->company_name ?? $prefilledData['company_name'] ?? 'Bharat Art & Craft') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold">Terms &amp; Shipping Conditions</label>
                    <textarea class="form-control small" name="terms" rows="2" 
                              placeholder="FOB Jodhpur / Mundra Sea Port. Payment: 30% advance, balance against B/L scan.">{{ old('terms', $quotation->terms ?? "FOB Mundra Port, India. Packaging: 7-Ply export corrugated carton with foam edge guards. Production lead time: 35-45 days.") }}</textarea>
                </div>

            </div>
        </div>

    </div>

    <!-- RIGHT COLUMN: MULTIPLE PRODUCTS REPEATER -->
    <div class="col-lg-8">
        
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h5 class="card-title text-dark mb-0 fs-6 fw-bold">
                        <i class="bi bi-boxes text-primary me-2"></i> Selected Quotation Products
                    </h5>
                    <p class="small text-muted mb-0">Select multiple catalog pieces or customize specifications per item.</p>
                </div>
                <div>
                    <button type="button" class="btn btn-sm btn-primary shadow-sm" id="btn_add_product">
                        <i class="bi bi-plus-circle me-1"></i> Add Another Product
                    </button>
                </div>
            </div>

            <div class="card-body p-0">
                
                <div id="items_container" class="p-3 d-flex flex-column gap-3">
                    <!-- Populated dynamically via JS -->
                </div>

                <!-- Empty State Alert if No Items -->
                <div id="empty_items_alert" class="p-5 text-center text-muted d-none">
                    <i class="bi bi-box-seam fs-1 d-block mb-2 text-secondary opacity-50"></i>
                    <p class="fw-bold mb-1">No products added yet.</p>
                    <p class="small text-muted mb-3">Click the "Add Another Product" button above to insert pieces into this quotation.</p>
                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="document.getElementById('btn_add_product').click()">
                        <i class="bi bi-plus-lg me-1"></i> Add First Product
                    </button>
                </div>

            </div>

            <!-- Total Calculations Footer -->
            <div class="card-footer bg-light py-3 border-top">
                <div class="row align-items-center g-3">
                    <div class="col-sm-4">
                        <div class="small text-muted">Total Products:</div>
                        <div class="fs-5 fw-bold text-dark" id="disp_total_items">0 pcs</div>
                    </div>
                    <div class="col-sm-4">
                        <div class="small text-muted">Total Estimated Volume:</div>
                        <div class="fs-5 fw-bold text-primary" id="disp_total_cbm">0.00 CBM</div>
                        <div class="small text-muted" id="disp_container_fill" style="font-size: 0.75rem;">
                            ~0% of 40' HQ container (68 CBM)
                        </div>
                    </div>
                    <div class="col-sm-4 text-sm-end">
                        <div class="small text-muted">Estimated Total Value:</div>
                        <div class="fs-4 fw-bold text-success" id="disp_total_amount">$0.00</div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Submit & Actions -->
        <div class="d-flex align-items-center justify-content-between p-3 bg-white border rounded shadow-sm">
            <a href="{{ route('admin.quotation.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Cancel &amp; Return
            </a>
            <button type="submit" class="btn btn-success px-4 py-2 fw-bold shadow-sm">
                <i class="bi bi-check-circle me-1"></i> Save &amp; Generate Quotation
            </button>
        </div>

    </div>

</div>

<!-- EMBEDDED PRODUCTS CATALOG DATA FOR INSTANT CLIENT-SIDE LOOKUPS -->
<script>
window.BAC_Catalog = {!! json_encode($products->map(function($p) {
    $cbm = (float)($p->cbm ?: 0.45);
    $load = $cbm > 0 ? (floor(68 / $cbm) . " pcs / 40' HC") : "100 pcs";
    return [
        'id' => $p->id,
        'title' => $p->title,
        'code' => $p->code ?? '',
        'price' => (float)($p->price ?? 0),
        'cbm' => $cbm,
        'dimension' => $p->dimension ?? '',
        'material' => $p->wood?->name ?? ($p->material ?? 'Solid Hardwood'),
        'finish' => $p->finish?->name ?? 'Natural Polish',
        'image' => $p->image_url,
        'loadability' => $load,
    ];
})) !!};

window.BAC_ExistingItems = {!! json_encode(old('items', isset($quotation) ? $quotation->items->map(function($it) {
    return [
        'product_id' => $it->product_id,
        'product_name' => $it->product_name,
        'product_code' => $it->product_code,
        'image' => $it->image_url,
        'material' => $it->material,
        'dimension' => $it->dimension,
        'finish' => $it->finish,
        'moq' => $it->moq,
        'price_usd' => (float)$it->price_usd,
        'cbm' => (float)$it->cbm,
        'loadability' => $it->loadability,
        'notes' => $it->notes,
    ];
}) : ($prefilledData['items'] ?? []))) !!};
</script>

<style>
.quote-item-card {
    border: 1px solid #e2dacd;
    border-radius: 10px;
    background: #ffffff;
    transition: all 0.2s ease;
}
.quote-item-card:hover {
    border-color: #c5a880;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}
.quote-item-thumb {
    width: 70px;
    height: 70px;
    border-radius: 6px;
    object-fit: cover;
    border: 1px solid #e0d8cc;
    background: #faf7f2;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const userSelect = document.getElementById('user_select');
    const custName = document.getElementById('customer_name');
    const custEmail = document.getElementById('customer_email');
    const custPhone = document.getElementById('customer_phone');
    const custCompany = document.getElementById('customer_company');
    const custAddress = document.getElementById('customer_address');
    const modeExisting = document.getElementById('mode_existing');
    const modeNew = document.getElementById('mode_new');
    const secExisting = document.getElementById('section_existing_user');
    const createUserSwitchWrap = document.getElementById('create_user_switch_wrap');
    const createUserCheck = document.getElementById('create_new_user');

    // 1. User Selection & Mode Switcher
    function handleModeChange() {
        if (modeNew && modeNew.checked) {
            secExisting.classList.add('d-none');
            createUserSwitchWrap.classList.remove('d-none');
            createUserCheck.checked = true;
            if (userSelect) userSelect.value = '';
        } else {
            secExisting.classList.remove('d-none');
            createUserSwitchWrap.classList.add('d-none');
            createUserCheck.checked = false;
        }
    }

    if (modeExisting) modeExisting.addEventListener('change', handleModeChange);
    if (modeNew) modeNew.addEventListener('change', handleModeChange);

    if (userSelect) {
        userSelect.addEventListener('change', function() {
            const opt = this.options[this.selectedIndex];
            if (opt && opt.value) {
                if (custName) custName.value = opt.getAttribute('data-name') || '';
                if (custEmail) custEmail.value = opt.getAttribute('data-email') || '';
                if (custPhone) custPhone.value = opt.getAttribute('data-phone') || '';
                if (custCompany) custCompany.value = opt.getAttribute('data-company') || '';
            }
        });
    }

    // 2. Dynamic Quotation Items Repeater
    const container = document.getElementById('items_container');
    const emptyAlert = document.getElementById('empty_items_alert');
    const btnAdd = document.getElementById('btn_add_product');

    let itemIndex = 0;

    function renderItemRow(data = {}) {
        const idx = itemIndex++;
        const prodId = data.product_id || '';
        const name = data.product_name || '';
        const code = data.product_code || '';
        const img = data.image || '/assets/img/fur_new_sideboard.png';
        const material = data.material || '';
        const dimension = data.dimension || '';
        const finish = data.finish || '';
        const moq = data.moq !== undefined ? data.moq : 5;
        const price = data.price_usd !== undefined ? data.price_usd : 0;
        const cbm = data.cbm !== undefined ? data.cbm : 0.45;
        const load = data.loadability || (cbm > 0 ? (Math.floor(68 / cbm) + " pcs / 40' HC") : "100 pcs");
        const notes = data.notes || '';

        // Product options
        let optionsHtml = '<option value="">-- Choose from Catalog --</option>';
        window.BAC_Catalog.forEach(p => {
            const isSel = (p.id == prodId) ? 'selected' : '';
            optionsHtml += `<option value="${p.id}" ${isSel}>${p.title} ${p.code ? '[' + p.code + ']' : ''}</option>`;
        });

        const rowHtml = `
            <div class="quote-item-card p-3" id="item_row_${idx}">
                <div class="d-flex align-items-start justify-content-between gap-3 mb-2 pb-2 border-bottom">
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-dark rounded-circle px-2 py-1 item-badge-num">#${container.children.length + 1}</span>
                        <span class="fw-bold text-dark item-title-display">${name || 'Select Product Piece'}</span>
                        <span class="small text-muted item-code-display">${code ? '[' + code + ']' : ''}</span>
                    </div>
                    <div>
                        <button type="button" class="btn btn-sm btn-outline-danger remove-item-btn" data-target="item_row_${idx}" title="Remove this item">
                            <i class="bi bi-trash me-1"></i> Remove
                        </button>
                    </div>
                </div>

                <div class="row g-3 align-items-center">
                    <!-- Thumbnail Image -->
                    <div class="col-auto">
                        <img src="${img}" class="quote-item-thumb item-img-preview" alt="Piece thumbnail">
                        <input type="hidden" name="items[${idx}][image]" class="item-img-input" value="${img}">
                        <input type="hidden" name="items[${idx}][product_code]" class="item-code-input" value="${code}">
                    </div>

                    <!-- Product Select & Custom Name -->
                    <div class="col-md-5">
                        <label class="form-label small fw-bold mb-1">Select Product Catalog Piece</label>
                        <select name="items[${idx}][product_id]" class="form-select form-select-sm item-prod-select mb-2">
                            ${optionsHtml}
                        </select>
                        <input type="text" name="items[${idx}][product_name]" class="form-control form-control-sm item-name-input fw-semibold" 
                               required value="${name}" placeholder="Custom or Catalog Product Name">
                    </div>

                    <!-- Material & Finish -->
                    <div class="col-md-3">
                        <label class="form-label small fw-bold mb-1">Material (Wood)</label>
                        <input type="text" name="items[${idx}][material]" class="form-control form-control-sm item-material-input mb-2" 
                               value="${material}" placeholder="e.g. Sheesham / Teak Wood">

                        <label class="form-label small fw-bold mb-1">Surface Finish</label>
                        <input type="text" name="items[${idx}][finish]" class="form-control form-control-sm item-finish-input" 
                               value="${finish}" placeholder="e.g. Natural Honey Wax">
                    </div>

                    <!-- Dimension & Loadability -->
                    <div class="col-md-3">
                        <label class="form-label small fw-bold mb-1">Dimension (CMS)</label>
                        <input type="text" name="items[${idx}][dimension]" class="form-control form-control-sm item-dimension-input mb-2" 
                               value="${dimension}" placeholder="e.g. 180 x 90 x 76 cm">

                        <label class="form-label small fw-bold mb-1">Loadability (40' HC)</label>
                        <input type="text" name="items[${idx}][loadability]" class="form-control form-control-sm item-loadability-input" 
                               value="${load}" placeholder="e.g. 133 pcs / 40' HC">
                    </div>
                </div>

                <!-- Numerical Pricing Row -->
                <div class="row g-3 align-items-center mt-1 pt-2 bg-light rounded px-2 pb-2">
                    <div class="col-sm-3">
                        <label class="form-label small fw-bold mb-1">MOQ (Min Order Qty)</label>
                        <div class="input-group input-group-sm">
                            <input type="number" min="1" name="items[${idx}][moq]" class="form-control item-moq-input" value="${moq}">
                            <span class="input-group-text">pcs</span>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <label class="form-label small fw-bold mb-1">Price (USD $)</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text">$</span>
                            <input type="number" step="0.01" min="0" name="items[${idx}][price_usd]" class="form-control item-price-input" value="${price}">
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <label class="form-label small fw-bold mb-1">CBM (Per Unit)</label>
                        <div class="input-group input-group-sm">
                            <input type="number" step="0.001" min="0" name="items[${idx}][cbm]" class="form-control item-cbm-input" value="${cbm}">
                            <span class="input-group-text">m³</span>
                        </div>
                    </div>

                    <div class="col-sm-3 text-end">
                        <div class="small text-muted">Line Subtotal:</div>
                        <div class="fw-bold text-dark item-line-subtotal">$${(moq * price).toFixed(2)}</div>
                        <div class="small text-primary item-line-cbm">${(moq * cbm).toFixed(2)} CBM</div>
                    </div>
                </div>

            </div>
        `;

        container.insertAdjacentHTML('beforeend', rowHtml);
        attachRowEvents(document.getElementById(`item_row_${idx}`));
        updateTotals();
    }

    function attachRowEvents(row) {
        if (!row) return;

        const prodSelect = row.querySelector('.item-prod-select');
        const nameInput = row.querySelector('.item-name-input');
        const codeInput = row.querySelector('.item-code-input');
        const materialInput = row.querySelector('.item-material-input');
        const dimensionInput = row.querySelector('.item-dimension-input');
        const finishInput = row.querySelector('.item-finish-input');
        const priceInput = row.querySelector('.item-price-input');
        const cbmInput = row.querySelector('.item-cbm-input');
        const loadInput = row.querySelector('.item-loadability-input');
        const imgInput = row.querySelector('.item-img-input');
        const imgPrev = row.querySelector('.item-img-preview');
        const titleDisp = row.querySelector('.item-title-display');
        const codeDisp = row.querySelector('.item-code-display');
        const moqInput = row.querySelector('.item-moq-input');
        const removeBtn = row.querySelector('.remove-item-btn');

        // Product selection auto fetch
        if (prodSelect) {
            prodSelect.addEventListener('change', function() {
                const pId = this.value;
                const found = window.BAC_Catalog.find(p => p.id == pId);
                if (found) {
                    if (nameInput) nameInput.value = found.title;
                    if (titleDisp) titleDisp.textContent = found.title;
                    if (codeInput) codeInput.value = found.code;
                    if (codeDisp) codeDisp.textContent = found.code ? `[${found.code}]` : '';
                    if (materialInput) materialInput.value = found.material;
                    if (dimensionInput) dimensionInput.value = found.dimension;
                    if (finishInput) finishInput.value = found.finish;
                    if (priceInput) priceInput.value = found.price;
                    if (cbmInput) cbmInput.value = found.cbm;
                    if (loadInput) loadInput.value = found.loadability;
                    if (imgInput) imgInput.value = found.image;
                    if (imgPrev) imgPrev.src = found.image;
                }
                updateTotals();
            });
        }

        // CBM change auto updates loadability
        if (cbmInput) {
            cbmInput.addEventListener('input', function() {
                const val = parseFloat(this.value) || 0;
                if (val > 0 && loadInput) {
                    const pcs = Math.floor(68 / val);
                    loadInput.value = `${pcs} pcs / 40' HC`;
                }
                updateTotals();
            });
        }

        [nameInput, priceInput, moqInput].forEach(inp => {
            if (inp) {
                inp.addEventListener('input', updateTotals);
            }
        });

        if (removeBtn) {
            removeBtn.addEventListener('click', function() {
                row.remove();
                renumberRows();
                updateTotals();
            });
        }
    }

    function renumberRows() {
        const rows = container.querySelectorAll('.quote-item-card');
        rows.forEach((r, i) => {
            const badge = r.querySelector('.item-badge-num');
            if (badge) badge.textContent = `#${i + 1}`;
        });
    }

    function updateTotals() {
        const rows = container.querySelectorAll('.quote-item-card');
        if (emptyAlert) {
            if (rows.length === 0) {
                emptyAlert.classList.remove('d-none');
            } else {
                emptyAlert.classList.add('d-none');
            }
        }

        let totalQty = 0;
        let totalCbm = 0;
        let totalAmount = 0;

        rows.forEach(r => {
            const moq = parseInt(r.querySelector('.item-moq-input')?.value, 10) || 1;
            const price = parseFloat(r.querySelector('.item-price-input')?.value) || 0;
            const cbm = parseFloat(r.querySelector('.item-cbm-input')?.value) || 0;

            const linePrice = moq * price;
            const lineCbm = moq * cbm;

            totalQty += moq;
            totalCbm += lineCbm;
            totalAmount += linePrice;

            const subEl = r.querySelector('.item-line-subtotal');
            const cbmEl = r.querySelector('.item-line-cbm');
            if (subEl) subEl.textContent = `$${linePrice.toFixed(2)}`;
            if (cbmEl) cbmEl.textContent = `${lineCbm.toFixed(2)} CBM`;
        });

        const dispItems = document.getElementById('disp_total_items');
        const dispCbm = document.getElementById('disp_total_cbm');
        const dispAmt = document.getElementById('disp_total_amount');
        const dispFill = document.getElementById('disp_container_fill');

        if (dispItems) dispItems.textContent = `${totalQty} pcs (${rows.length} pieces)`;
        if (dispCbm) dispCbm.textContent = `${totalCbm.toFixed(2)} CBM`;
        if (dispAmt) dispAmt.textContent = `$${totalAmount.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;

        if (dispFill) {
            const pct = Math.min(100, Math.round((totalCbm / 68) * 100));
            dispFill.textContent = `~${pct}% of 40' HQ container (68 CBM capacity)`;
        }
    }

    if (btnAdd) {
        btnAdd.addEventListener('click', function() {
            renderItemRow();
        });
    }

    // Populate existing items or default item
    if (window.BAC_ExistingItems && window.BAC_ExistingItems.length > 0) {
        window.BAC_ExistingItems.forEach(it => renderItemRow(it));
    } else {
        renderItemRow();
    }
});
</script>
