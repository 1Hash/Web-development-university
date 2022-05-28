using System;
using System.Collections.Generic;
using System.Data;
using System.Data.Entity;
using System.Linq;
using System.Net;
using System.Web;
using System.Web.Mvc;
using CarpoolingEL;

namespace CarpoolingEL.Controllers
{
    public class DestinosController : Controller
    {
        private CarpoolingELEntities db = new CarpoolingELEntities();

        // GET: Destinos
        public ActionResult Index()
        {

            int v = Convert.ToInt32(Session["UserID"]);
            var dESTINOS = db.DESTINOS.Where(c => c.fkUsu == v);
            return View(dESTINOS.ToList());
        }

        // GET: Destinos/Details/5
        public ActionResult Detalhes(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            DESTINOS dESTINOS = db.DESTINOS.Find(id);
            if (dESTINOS == null)
            {
                return HttpNotFound();
            }
            return View(dESTINOS);
        }

        // GET: Destinos/Create
        public ActionResult Create()
        {
            return View();
        }

        // POST: Destinos/Create
        // Para se proteger de mais ataques, ative as propriedades específicas a que você quer se conectar. Para 
        // obter mais detalhes, consulte https://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Create([Bind(Include = "idDest,endDest,compDest,cepDest,bairroDest,cidadeDest,ufDest,fkUsu")] DESTINOS dESTINOS)
        {
            if (ModelState.IsValid)
            {
                db.DESTINOS.Add(dESTINOS);
                db.SaveChanges();
                return RedirectToAction("Index");
            }

            return View(dESTINOS);
        }

        // GET: Destinos/Edit/5
        public ActionResult Editar(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            DESTINOS dESTINOS = db.DESTINOS.Find(id);
            if (dESTINOS == null)
            {
                return HttpNotFound();
            }
            return View(dESTINOS);
        }

        // POST: Destinos/Edit/5
        // Para se proteger de mais ataques, ative as propriedades específicas a que você quer se conectar. Para 
        // obter mais detalhes, consulte https://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Editar([Bind(Include = "idDest,endDest,compDest,cepDest,bairroDest,cidadeDest,ufDest,fkUsu")] DESTINOS dESTINOS)
        {
            if (ModelState.IsValid)
            {
                db.Entry(dESTINOS).State = EntityState.Modified;
                db.SaveChanges();
                return RedirectToAction("Index");
            }
            return View(dESTINOS);
        }

        protected override void Dispose(bool disposing)
        {
            if (disposing)
            {
                db.Dispose();
            }
            base.Dispose(disposing);
        }
    }
}
