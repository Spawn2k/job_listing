<section class="footer">
    <div>
        <div>
            <h2>Looking to hire ?</h2>
            <p>Post your job listing now and find perfet candidate.</p>
        </div>
            <?php if(isset($_SESSION['user'])): ?>
                <a href="/listings/create">
                    <button>Post a job</button>
                </a>
            <?php endif ?>
        </div>
</section>

</body>

</html>
