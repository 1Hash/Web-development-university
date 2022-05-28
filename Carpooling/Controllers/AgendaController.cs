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
    public class AgendaController : Controller
    {
        private CarpoolingELEntities db = new CarpoolingELEntities();

        // GET: Agenda
        public ActionResult Index()
        {
            int v = Convert.ToInt32(Session["UserID"]);
            var aGENDA = db.AGENDA.Where(c => c.fkUsu == v);
            return View(aGENDA.ToList());
        }

        // GET: Agenda/Details/5
        public ActionResult Detalhes(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            AGENDA aGENDA = db.AGENDA.Find(id);
            if (aGENDA == null)
            {
                return HttpNotFound();
            }
            return View(aGENDA);
        }

        // GET: Agenda/Create
        public ActionResult Create()
        {
            int v = Convert.ToInt32(Session["UserID"]);
            var q = db.CARROS.Where(c => c.fkUsu == v);
            var q2 = db.DESTINOS.Where(c => c.fkUsu == v);
            ViewBag.fkCar = new SelectList(q, "idCar", "modeloCar");
            ViewBag.fkDest = new SelectList(q2, "idDest", "endDest");
            ViewBag.fkUsu = new SelectList(db.USUARIOS, "idUsu", "nomeUsu");
            return View();
        }

        // POST: Agenda/Create
        // Para se proteger de mais ataques, ative as propriedades específicas a que você quer se conectar. Para 
        // obter mais detalhes, consulte https://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Create([Bind(Include = "idAge,dhAge,fkCar,fkDest,fkUsu")] AGENDA aGENDA)
        {
            if (ModelState.IsValid)
            {
                db.AGENDA.Add(aGENDA);
                db.SaveChanges();
                return RedirectToAction("Index");
            }

            ViewBag.fkCar = new SelectList(db.CARROS, "idCar", "modeloCar", aGENDA.fkCar);
            ViewBag.fkDest = new SelectList(db.DESTINOS, "idDest", "endDest", aGENDA.fkDest);
            ViewBag.fkUsu = new SelectList(db.USUARIOS, "idUsu", "nomeUsu", aGENDA.fkUsu);
            return View(aGENDA);
        }

        // GET: Agenda/Edit/5
        public ActionResult Editar(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            AGENDA aGENDA = db.AGENDA.Find(id);
            if (aGENDA == null)
            {
                return HttpNotFound();
            }
            ViewBag.fkCar = new SelectList(db.CARROS, "idCar", "modeloCar", aGENDA.fkCar);
            ViewBag.fkDest = new SelectList(db.DESTINOS, "idDest", "endDest", aGENDA.fkDest);
            ViewBag.fkUsu = new SelectList(db.USUARIOS, "idUsu", "nomeUsu", aGENDA.fkUsu);
            return View(aGENDA);
        }

        // POST: Agenda/Edit/5
        // Para se proteger de mais ataques, ative as propriedades específicas a que você quer se conectar. Para 
        // obter mais detalhes, consulte https://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Editar([Bind(Include = "idAge,dhAge,fkCar,fkDest,fkUsu")] AGENDA aGENDA)
        {
            if (ModelState.IsValid)
            {
                db.Entry(aGENDA).State = EntityState.Modified;
                db.SaveChanges();
                return RedirectToAction("Index");
            }
            ViewBag.fkCar = new SelectList(db.CARROS, "idCar", "modeloCar", aGENDA.fkCar);
            ViewBag.fkDest = new SelectList(db.DESTINOS, "idDest", "endDest", aGENDA.fkDest);
            ViewBag.fkUsu = new SelectList(db.USUARIOS, "idUsu", "nomeUsu", aGENDA.fkUsu);
            return View(aGENDA);
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
