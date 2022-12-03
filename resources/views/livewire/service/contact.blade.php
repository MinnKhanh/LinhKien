<div>
    <div class="map">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.9893909389816!2d105.79916211401604!3d21.033110493007726!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab40e632f74f%3A0xfb0998164f1effbb!2zMyDEkC4gQ-G6p3UgR2nhuqV5LCBRdWFuIEhvYSwgQ-G6p3UgR2nhuqV5LCBIw6AgTuG7mWksIFZpZXRuYW0!5e0!3m2!1sen!2s!4v1670094578655!5m2!1sen!2s"
            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <!-- Map End -->

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="contact__text">
                        <div class="section-title">
                            <span>Thông tin</span>
                            <h2>Lời nhắn</h2>
                            <p>{{ $infor['message'] }}</p>
                        </div>
                        <ul>
                            <li>
                                <h4>{{ $infor['nation'] }}</h4>
                                <p>{{ $infor['address'] }} <br />{{ $infor['phone'] }}</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="contact__form">
                        <form>
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" wire:model.defer="name" placeholder="Tên">
                                    <p class="error">
                                        @error('name')
                                            <strong>{{ $message }}</strong>
                                        @enderror
                                    </p>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" wire:model.defer="email" placeholder="Email">
                                    <p class="error">
                                        @error('email')
                                            <strong>{{ $message }}</strong>
                                        @enderror
                                    </p>
                                </div>
                                <div class="col-lg-12">
                                    <textarea wire:model.defer="message" placeholder="Lời nhắn"></textarea>
                                    <p class="error">
                                        @error('message')
                                            <strong>{{ $message }}</strong>
                                        @enderror
                                    </p>
                                    <button type="button" wire:click="sendMessage" class="site-btn">Gửi lời
                                        nhắn</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // function escapeHtml(text) {
            //     var map = {
            //         '&': '&amp;',
            //         '<': '&lt;',
            //         '>': '&gt;',
            //         '"': '&quot;',
            //         "'": '&#039;'
            //     };

            //     return text.replace(/[&<>"']/g, function(m) {
            //         return map[m];
            //     });
            // }
            // let coord = '{{ $infor['coordinates'] }}'
            // let text = escapeHtml(coord)
            // document.getElementById('map').innerHTML = text
        })
    </script>
</div>
