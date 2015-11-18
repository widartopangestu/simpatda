--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

--
-- Name: access_log_seq; Type: SEQUENCE; Schema: public; Owner: simpatdadb
--

CREATE SEQUENCE access_log_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE access_log_seq OWNER TO simpatdadb;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: access_log; Type: TABLE; Schema: public; Owner: simpatdadb; Tablespace: 
--

CREATE TABLE access_log (
    id integer DEFAULT nextval('access_log_seq'::regclass) NOT NULL,
    type smallint,
    activity text,
    "time" character varying(50) NOT NULL,
    user_id integer NOT NULL
);


ALTER TABLE access_log OWNER TO simpatdadb;

--
-- Name: bidang_usaha; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE bidang_usaha (
    id integer NOT NULL,
    kode character varying(3) NOT NULL,
    nama character varying(255) NOT NULL,
    created timestamp without time zone,
    updated timestamp without time zone
);


ALTER TABLE bidang_usaha OWNER TO postgres;

--
-- Name: bidang_usaha_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE bidang_usaha_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE bidang_usaha_id_seq OWNER TO postgres;

--
-- Name: bidang_usaha_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE bidang_usaha_id_seq OWNED BY bidang_usaha.id;


--
-- Name: golongan; Type: TABLE; Schema: public; Owner: simpatdadb; Tablespace: 
--

CREATE TABLE golongan (
    id integer NOT NULL,
    nama character varying(10) NOT NULL,
    created timestamp without time zone,
    updated timestamp without time zone
);


ALTER TABLE golongan OWNER TO simpatdadb;

--
-- Name: golongan_id_seq; Type: SEQUENCE; Schema: public; Owner: simpatdadb
--

CREATE SEQUENCE golongan_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE golongan_id_seq OWNER TO simpatdadb;

--
-- Name: golongan_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simpatdadb
--

ALTER SEQUENCE golongan_id_seq OWNED BY golongan.id;


--
-- Name: jabatan; Type: TABLE; Schema: public; Owner: simpatdadb; Tablespace: 
--

CREATE TABLE jabatan (
    id integer NOT NULL,
    nama character varying(255) NOT NULL,
    created timestamp without time zone,
    updated timestamp without time zone
);


ALTER TABLE jabatan OWNER TO simpatdadb;

--
-- Name: jabatan_id_seq; Type: SEQUENCE; Schema: public; Owner: simpatdadb
--

CREATE SEQUENCE jabatan_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE jabatan_id_seq OWNER TO simpatdadb;

--
-- Name: jabatan_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simpatdadb
--

ALTER SEQUENCE jabatan_id_seq OWNED BY jabatan.id;


--
-- Name: jenis_surat; Type: TABLE; Schema: public; Owner: simpatdadb; Tablespace: 
--

CREATE TABLE jenis_surat (
    id integer NOT NULL,
    kode character varying(1) NOT NULL,
    nama character varying(255) NOT NULL,
    singkatan character varying(20),
    is_official boolean DEFAULT true NOT NULL,
    is_self boolean DEFAULT true NOT NULL,
    created timestamp without time zone,
    updated timestamp without time zone
);


ALTER TABLE jenis_surat OWNER TO simpatdadb;

--
-- Name: jenis_surat_id_seq; Type: SEQUENCE; Schema: public; Owner: simpatdadb
--

CREATE SEQUENCE jenis_surat_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE jenis_surat_id_seq OWNER TO simpatdadb;

--
-- Name: jenis_surat_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simpatdadb
--

ALTER SEQUENCE jenis_surat_id_seq OWNED BY jenis_surat.id;


--
-- Name: kecamatan; Type: TABLE; Schema: public; Owner: simpatdadb; Tablespace: 
--

CREATE TABLE kecamatan (
    id integer NOT NULL,
    kode character varying(2) NOT NULL,
    nama character varying(255) NOT NULL,
    created timestamp without time zone,
    updated timestamp without time zone
);


ALTER TABLE kecamatan OWNER TO simpatdadb;

--
-- Name: kecamatan_id_seq; Type: SEQUENCE; Schema: public; Owner: simpatdadb
--

CREATE SEQUENCE kecamatan_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE kecamatan_id_seq OWNER TO simpatdadb;

--
-- Name: kecamatan_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simpatdadb
--

ALTER SEQUENCE kecamatan_id_seq OWNED BY kecamatan.id;


--
-- Name: kelurahan; Type: TABLE; Schema: public; Owner: simpatdadb; Tablespace: 
--

CREATE TABLE kelurahan (
    id integer NOT NULL,
    kode character varying(2) NOT NULL,
    nama character varying(255) NOT NULL,
    created timestamp without time zone,
    updated timestamp without time zone,
    kecamatan_id integer NOT NULL
);


ALTER TABLE kelurahan OWNER TO simpatdadb;

--
-- Name: kelurahan_id_seq; Type: SEQUENCE; Schema: public; Owner: simpatdadb
--

CREATE SEQUENCE kelurahan_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE kelurahan_id_seq OWNER TO simpatdadb;

--
-- Name: kelurahan_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simpatdadb
--

ALTER SEQUENCE kelurahan_id_seq OWNED BY kelurahan.id;


--
-- Name: kode_rekening; Type: TABLE; Schema: public; Owner: simpatdadb; Tablespace: 
--

CREATE TABLE kode_rekening (
    id integer NOT NULL,
    kode character varying(255) NOT NULL,
    nama character varying(255) NOT NULL,
    tarif_persen double precision,
    tarif_dasar double precision,
    created timestamp without time zone,
    updated timestamp without time zone,
    parent_id integer
);


ALTER TABLE kode_rekening OWNER TO simpatdadb;

--
-- Name: kode_rekening_id_seq; Type: SEQUENCE; Schema: public; Owner: simpatdadb
--

CREATE SEQUENCE kode_rekening_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE kode_rekening_id_seq OWNER TO simpatdadb;

--
-- Name: kode_rekening_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simpatdadb
--

ALTER SEQUENCE kode_rekening_id_seq OWNED BY kode_rekening.id;


--
-- Name: message_seq; Type: SEQUENCE; Schema: public; Owner: simpatdadb
--

CREATE SEQUENCE message_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE message_seq OWNER TO simpatdadb;

--
-- Name: message; Type: TABLE; Schema: public; Owner: simpatdadb; Tablespace: 
--

CREATE TABLE message (
    id integer DEFAULT nextval('message_seq'::regclass) NOT NULL,
    language character varying(16) NOT NULL,
    translation text
);


ALTER TABLE message OWNER TO simpatdadb;

--
-- Name: operation_seq; Type: SEQUENCE; Schema: public; Owner: simpatdadb
--

CREATE SEQUENCE operation_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE operation_seq OWNER TO simpatdadb;

--
-- Name: operation; Type: TABLE; Schema: public; Owner: simpatdadb; Tablespace: 
--

CREATE TABLE operation (
    id integer DEFAULT nextval('operation_seq'::regclass) NOT NULL,
    name character varying(255) NOT NULL,
    description text,
    nama_modul character varying(255) NOT NULL,
    grup smallint DEFAULT 1 NOT NULL,
    urutan_ke smallint DEFAULT 1 NOT NULL,
    tampilkan_dirole smallint DEFAULT 1 NOT NULL
);


ALTER TABLE operation OWNER TO simpatdadb;

--
-- Name: pangkat; Type: TABLE; Schema: public; Owner: simpatdadb; Tablespace: 
--

CREATE TABLE pangkat (
    id integer NOT NULL,
    nama character varying(100) NOT NULL,
    created timestamp without time zone,
    updated timestamp without time zone
);


ALTER TABLE pangkat OWNER TO simpatdadb;

--
-- Name: pangkat_id_seq; Type: SEQUENCE; Schema: public; Owner: simpatdadb
--

CREATE SEQUENCE pangkat_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE pangkat_id_seq OWNER TO simpatdadb;

--
-- Name: pangkat_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simpatdadb
--

ALTER SEQUENCE pangkat_id_seq OWNED BY pangkat.id;


--
-- Name: pejabat; Type: TABLE; Schema: public; Owner: simpatdadb; Tablespace: 
--

CREATE TABLE pejabat (
    id integer NOT NULL,
    kode character varying(2) NOT NULL,
    nama character varying(255) NOT NULL,
    nip character varying(30) NOT NULL,
    status boolean DEFAULT true NOT NULL,
    created timestamp without time zone,
    updated timestamp without time zone,
    golongan_id integer NOT NULL,
    jabatan_id integer NOT NULL,
    pangkat_id integer NOT NULL
);


ALTER TABLE pejabat OWNER TO simpatdadb;

--
-- Name: pejabat_id_seq; Type: SEQUENCE; Schema: public; Owner: simpatdadb
--

CREATE SEQUENCE pejabat_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE pejabat_id_seq OWNER TO simpatdadb;

--
-- Name: pejabat_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simpatdadb
--

ALTER SEQUENCE pejabat_id_seq OWNED BY pejabat.id;


--
-- Name: role_seq; Type: SEQUENCE; Schema: public; Owner: simpatdadb
--

CREATE SEQUENCE role_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE role_seq OWNER TO simpatdadb;

--
-- Name: role; Type: TABLE; Schema: public; Owner: simpatdadb; Tablespace: 
--

CREATE TABLE role (
    id integer DEFAULT nextval('role_seq'::regclass) NOT NULL,
    name character varying(255) NOT NULL
);


ALTER TABLE role OWNER TO simpatdadb;

--
-- Name: role_access; Type: TABLE; Schema: public; Owner: simpatdadb; Tablespace: 
--

CREATE TABLE role_access (
    role_id integer NOT NULL,
    operation_id integer NOT NULL
);


ALTER TABLE role_access OWNER TO simpatdadb;

--
-- Name: sourcemessage_seq; Type: SEQUENCE; Schema: public; Owner: simpatdadb
--

CREATE SEQUENCE sourcemessage_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sourcemessage_seq OWNER TO simpatdadb;

--
-- Name: sourcemessage; Type: TABLE; Schema: public; Owner: simpatdadb; Tablespace: 
--

CREATE TABLE sourcemessage (
    id integer DEFAULT nextval('sourcemessage_seq'::regclass) NOT NULL,
    category character varying(32),
    message text
);


ALTER TABLE sourcemessage OWNER TO simpatdadb;

--
-- Name: user_seq; Type: SEQUENCE; Schema: public; Owner: simpatdadb
--

CREATE SEQUENCE user_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE user_seq OWNER TO simpatdadb;

--
-- Name: user; Type: TABLE; Schema: public; Owner: simpatdadb; Tablespace: 
--

CREATE TABLE "user" (
    id integer DEFAULT nextval('user_seq'::regclass) NOT NULL,
    username character varying(255) NOT NULL,
    image character varying(255) DEFAULT 'no_image.png'::character varying NOT NULL,
    password character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    fullname character varying(255) DEFAULT NULL::character varying,
    phone_1 character varying(15) DEFAULT NULL::character varying,
    phone_2 character varying(15) DEFAULT NULL::character varying,
    address text,
    status smallint NOT NULL,
    last_login timestamp without time zone,
    activkey character varying(45) DEFAULT NULL::character varying,
    role_id integer
);


ALTER TABLE "user" OWNER TO simpatdadb;

--
-- Name: wajib_pajak; Type: TABLE; Schema: public; Owner: simpatdadb; Tablespace: 
--

CREATE TABLE wajib_pajak (
    id bigint NOT NULL,
    jenis character varying(1) NOT NULL,
    golongan smallint DEFAULT 1 NOT NULL,
    nomor character varying(7) NOT NULL,
    nama character varying(255) NOT NULL,
    alamat text,
    kabupaten character varying(255) NOT NULL,
    kecamatan character varying(255) NOT NULL,
    kelurahan character varying(255) NOT NULL,
    telepon character varying(20) NOT NULL,
    status boolean DEFAULT true NOT NULL,
    tanggal_tutup timestamp without time zone,
    kodepos character varying(5) NOT NULL,
    id_jenis integer,
    id_nomor character varying(255) DEFAULT NULL::character varying,
    tanggal_lahir timestamp without time zone,
    kk_nomor character varying(255) DEFAULT NULL::character varying,
    kk_tanggal timestamp without time zone,
    pekerjaan character varying(255) DEFAULT NULL::character varying,
    alamat_pekerjaan text,
    bu_nama character varying(255) DEFAULT NULL::character varying,
    bu_alamat text,
    bu_kabupaten character varying(255) DEFAULT NULL::character varying,
    bu_kecamatan character varying(255) DEFAULT NULL::character varying,
    bu_kelurahan character varying(255) DEFAULT NULL::character varying,
    bu_telepon character varying(20) DEFAULT NULL::character varying,
    bu_kodepos character varying(5) DEFAULT NULL::character varying,
    kelurahan_id integer,
    kecamatan_id integer,
    bidang_usaha_id integer,
    warga_negara character varying(5) DEFAULT 'WNI'::character varying NOT NULL,
    created timestamp without time zone,
    updated timestamp without time zone
);


ALTER TABLE wajib_pajak OWNER TO simpatdadb;

--
-- Name: wajib_pajak_id_seq; Type: SEQUENCE; Schema: public; Owner: simpatdadb
--

CREATE SEQUENCE wajib_pajak_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE wajib_pajak_id_seq OWNER TO simpatdadb;

--
-- Name: wajib_pajak_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simpatdadb
--

ALTER SEQUENCE wajib_pajak_id_seq OWNED BY wajib_pajak.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY bidang_usaha ALTER COLUMN id SET DEFAULT nextval('bidang_usaha_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simpatdadb
--

ALTER TABLE ONLY golongan ALTER COLUMN id SET DEFAULT nextval('golongan_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simpatdadb
--

ALTER TABLE ONLY jabatan ALTER COLUMN id SET DEFAULT nextval('jabatan_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simpatdadb
--

ALTER TABLE ONLY jenis_surat ALTER COLUMN id SET DEFAULT nextval('jenis_surat_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simpatdadb
--

ALTER TABLE ONLY kecamatan ALTER COLUMN id SET DEFAULT nextval('kecamatan_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simpatdadb
--

ALTER TABLE ONLY kelurahan ALTER COLUMN id SET DEFAULT nextval('kelurahan_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simpatdadb
--

ALTER TABLE ONLY kode_rekening ALTER COLUMN id SET DEFAULT nextval('kode_rekening_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simpatdadb
--

ALTER TABLE ONLY pangkat ALTER COLUMN id SET DEFAULT nextval('pangkat_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simpatdadb
--

ALTER TABLE ONLY pejabat ALTER COLUMN id SET DEFAULT nextval('pejabat_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simpatdadb
--

ALTER TABLE ONLY wajib_pajak ALTER COLUMN id SET DEFAULT nextval('wajib_pajak_id_seq'::regclass);


--
-- Data for Name: access_log; Type: TABLE DATA; Schema: public; Owner: simpatdadb
--

COPY access_log (id, type, activity, "time", user_id) FROM stdin;
1	3	Daftar Role	1447764586	1
2	2	Update Role ID : 1	1447764601	1
3	0	403 You do not have sufficient permissions to access this page. - Access Page : "/simpatda/role/1"	1447764601	1
4	2	View Role ID : 1	1447764808	1
5	2	Update Role ID : 1	1447764839	1
6	2	View Role ID : 1	1447764840	1
7	3	View Profile	1447765175	1
8	3	View Profile	1447765207	1
9	3	Daftar Operasi	1447766310	1
10	3	Daftar Operasi	1447766607	1
11	3	Daftar Operasi	1447766814	1
12	3	Daftar Operasi	1447766973	1
13	2	Generated bidangUsaha.view BidangUsaha View Success | Generated bidangUsaha.create BidangUsaha Create Success | Generated bidangUsaha.update BidangUsaha Update Success | Generated bidangUsaha.delete BidangUsaha Delete Success | Generated bidangUsaha.index BidangUsaha Index Success | Generated golongan.view Golongan View Success | Generated golongan.create Golongan Create Success | Generated golongan.update Golongan Update Success | Generated golongan.delete Golongan Delete Success | Generated golongan.index Golongan Index Success | Generated jabatan.view Jabatan View Success | Generated jabatan.create Jabatan Create Success | Generated jabatan.update Jabatan Update Success | Generated jabatan.delete Jabatan Delete Success | Generated jabatan.index Jabatan Index Success | Generated jenisSurat.view JenisSurat View Success | Generated jenisSurat.create JenisSurat Create Success | Generated jenisSurat.update JenisSurat Update Success | Generated jenisSurat.delete JenisSurat Delete Success | Generated jenisSurat.index JenisSurat Index Success | Generated kecamatan.view Kecamatan View Success | Generated kecamatan.create Kecamatan Create Success | Generated kecamatan.update Kecamatan Update Success | Generated kecamatan.delete Kecamatan Delete Success | Generated kecamatan.index Kecamatan Index Success | Generated kelurahan.view Kelurahan View Success | Generated kelurahan.create Kelurahan Create Success | Generated kelurahan.update Kelurahan Update Success | Generated kelurahan.delete Kelurahan Delete Success | Generated kelurahan.index Kelurahan Index Success | Generated kodeRekening.view KodeRekening View Success | Generated kodeRekening.create KodeRekening Create Success | Generated kodeRekening.update KodeRekening Update Success | Generated kodeRekening.delete KodeRekening Delete Success | Generated kodeRekening.index KodeRekening Index Success | Generated pangkat.view Pangkat View Success | Generated pangkat.create Pangkat Create Success | Generated pangkat.update Pangkat Update Success | Generated pangkat.delete Pangkat Delete Success | Generated pangkat.index Pangkat Index Success | Generated pejabat.view Pejabat View Success | Generated pejabat.create Pejabat Create Success | Generated pejabat.update Pejabat Update Success | Generated pejabat.delete Pejabat Delete Success | Generated pejabat.index Pejabat Index Success | Generated profile.changePassword Profile ChangePassword Success | Generated wajibPajak.view WajibPajak View Success | Generated wajibPajak.create WajibPajak Create Success | Generated wajibPajak.update WajibPajak Update Success | Generated wajibPajak.delete WajibPajak Delete Success | Generated wajibPajak.index WajibPajak Index Success | 	1447767056	1
14	3	Daftar Role	1447767062	1
15	3	Daftar Role	1447767274	1
16	3	Daftar Operasi	1447767322	1
17	3	Daftar Operasi	1447767329	1
18	3	Daftar Operasi	1447767334	1
19	3	Daftar Operasi	1447767337	1
20	3	Daftar Operasi	1447767343	1
21	2	Update Operation ID : 10	1447767385	1
22	3	Daftar Operasi	1447767386	1
23	2	Update Role ID : 1	1447767464	1
24	2	View Role ID : 1	1447767465	1
25	3	Manage Bidang Usahas	1447767486	1
26	3	Daftar Operasi	1447768923	1
27	3	Daftar Operasi	1447768981	1
28	3	Manage Bidang Usahas	1447769293	1
29	3	Manage Bidang Usahas	1447769414	1
30	3	Manage Jenis Surat	1447771262	1
31	3	Daftar Role	1447771711	1
32	2	Update Role ID : 1	1447771762	1
33	2	View Role ID : 1	1447771762	1
34	3	Daftar Operasi	1447771769	1
35	3	Daftar Operasi	1447771777	1
36	2	Delete Operation ID : 48	1447771782	1
37	3	Daftar Operasi	1447771782	1
38	3	Daftar Operasi	1447771795	1
39	2	Delete Operation ID : 53	1447771799	1
40	3	Daftar Operasi	1447771800	1
41	3	Daftar Operasi	1447771804	1
42	3	Daftar Operasi	1447771809	1
43	2	Delete Operation ID : 58	1447771812	1
44	3	Daftar Operasi	1447771813	1
45	3	Daftar Operasi	1447771816	1
46	2	Delete Operation ID : 73	1447771819	1
47	3	Daftar Operasi	1447771819	1
48	3	Daftar Operasi	1447771834	1
49	2	Delete Operation ID : 68	1447771838	1
50	3	Daftar Operasi	1447771838	1
51	3	Daftar Operasi	1447771854	1
52	2	Delete Operation ID : 83	1447771857	1
53	3	Daftar Operasi	1447771857	1
54	3	Daftar Role	1447771891	1
55	3	Manage Bidang Usaha	1447771920	1
56	3	Manage Bidang Usaha	1447772001	1
57	2	Create Bidang Usaha ID : 3	1447774355	1
58	0	404 Sistem tidak bisa menemukan action "view" seperti yang diminta. - Access Page : "/simpatda/bidangUsaha/3"	1447774355	1
59	3	Manage Bidang Usaha	1447774367	1
60	2	Update Bidang Usaha ID : 3	1447774794	1
61	0	404 Sistem tidak bisa menemukan action "view" seperti yang diminta. - Access Page : "/simpatda/bidangUsaha/3"	1447774795	1
62	3	Manage Bidang Usaha	1447774802	1
63	2	Delete Bidang Usaha ID : 3	1447774813	1
64	3	Manage Bidang Usaha	1447774813	1
65	2	Create Bidang Usaha ID : 4	1447774822	1
66	0	404 Sistem tidak bisa menemukan action "view" seperti yang diminta. - Access Page : "/simpatda/bidangUsaha/4"	1447774822	1
67	3	Manage Bidang Usaha	1447774827	1
68	2	Update Bidang Usaha ID : 4	1447774905	1
69	0	404 Sistem tidak bisa menemukan action "view" seperti yang diminta. - Access Page : "/simpatda/bidangUsaha/4"	1447774905	1
70	3	Manage Bidang Usaha	1447774909	1
71	2	Create Bidang Usaha ID : 5	1447775242	1
72	3	Manage Bidang Usaha	1447775243	1
73	3	Manage Bidang Usaha	1447775370	1
74	3	Manage Bidang Usaha	1447775390	1
75	3	Manage Jenis Surat	1447775696	1
76	2	Create Jenis Surat ID : 2	1447775982	1
77	3	View Jenis Surat ID : 2	1447775982	1
78	3	View Jenis Surat ID : 2	1447776023	1
79	3	Manage Bidang Usaha	1447776075	1
80	3	Manage Bidang Usaha	1447776115	1
\.


--
-- Name: access_log_seq; Type: SEQUENCE SET; Schema: public; Owner: simpatdadb
--

SELECT pg_catalog.setval('access_log_seq', 80, true);


--
-- Data for Name: bidang_usaha; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY bidang_usaha (id, kode, nama, created, updated) FROM stdin;
4	01	Hiburan	2015-11-17 22:40:22.04	2015-11-17 22:41:44.978
5	02	Pariwisata	2015-11-17 22:47:22.725	\N
\.


--
-- Name: bidang_usaha_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('bidang_usaha_id_seq', 5, true);


--
-- Data for Name: golongan; Type: TABLE DATA; Schema: public; Owner: simpatdadb
--

COPY golongan (id, nama, created, updated) FROM stdin;
\.


--
-- Name: golongan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: simpatdadb
--

SELECT pg_catalog.setval('golongan_id_seq', 1, false);


--
-- Data for Name: jabatan; Type: TABLE DATA; Schema: public; Owner: simpatdadb
--

COPY jabatan (id, nama, created, updated) FROM stdin;
\.


--
-- Name: jabatan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: simpatdadb
--

SELECT pg_catalog.setval('jabatan_id_seq', 1, false);


--
-- Data for Name: jenis_surat; Type: TABLE DATA; Schema: public; Owner: simpatdadb
--

COPY jenis_surat (id, kode, nama, singkatan, is_official, is_self, created, updated) FROM stdin;
2	1	Surat Pemberitahuan Pajak	SPT	t	t	2015-11-17 22:59:42.082	\N
\.


--
-- Name: jenis_surat_id_seq; Type: SEQUENCE SET; Schema: public; Owner: simpatdadb
--

SELECT pg_catalog.setval('jenis_surat_id_seq', 2, true);


--
-- Data for Name: kecamatan; Type: TABLE DATA; Schema: public; Owner: simpatdadb
--

COPY kecamatan (id, kode, nama, created, updated) FROM stdin;
\.


--
-- Name: kecamatan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: simpatdadb
--

SELECT pg_catalog.setval('kecamatan_id_seq', 1, false);


--
-- Data for Name: kelurahan; Type: TABLE DATA; Schema: public; Owner: simpatdadb
--

COPY kelurahan (id, kode, nama, created, updated, kecamatan_id) FROM stdin;
\.


--
-- Name: kelurahan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: simpatdadb
--

SELECT pg_catalog.setval('kelurahan_id_seq', 1, false);


--
-- Data for Name: kode_rekening; Type: TABLE DATA; Schema: public; Owner: simpatdadb
--

COPY kode_rekening (id, kode, nama, tarif_persen, tarif_dasar, created, updated, parent_id) FROM stdin;
\.


--
-- Name: kode_rekening_id_seq; Type: SEQUENCE SET; Schema: public; Owner: simpatdadb
--

SELECT pg_catalog.setval('kode_rekening_id_seq', 1, false);


--
-- Data for Name: message; Type: TABLE DATA; Schema: public; Owner: simpatdadb
--

COPY message (id, language, translation) FROM stdin;
1	id	Konfigurasi
2	id	Pengaturan
3	id	Field dengan
4	id	wajib diisi.
5	id	Sistem
6	id	Halaman Judul
7	id	Email Admin
8	id	Nama Perusahaan
9	id	Email Perusahaan
10	id	Izinkan pendaftaran pengguna?
11	id	Default Role untuk pengguna baru
12	id	Nama Perusahaan di Laporan
13	id	Deskripsi Perusahaan di Laporan
14	id	Alamat Perusahaan di Laporan
15	id	Bahasa
16	id	Jumlah baris default
17	id	Perusahaan
18	id	Alamat Perusahaan
19	id	Laporan
20	id	Simpan
21	id	Nama Aplikasi
22	id	Administrasi
23	id	Daftar Pengguna
24	id	Daftar Role
25	id	Daftar Operasi
26	id	Daftar Terjemah
27	id	Log Aktivitas Pengguna
28	id	Bantuan
29	id	Profile
30	id	Sunting Profil
31	id	Ganti Password
32	id	Login
33	id	Logout ({user})
36	id	Laporan Log Pengguna
37	id	SIMPATDA
38	id	Backup Database
39	id	Unggah Foto
40	id	Terjemahkan
41	id	Tampil
42	id	Operasi
43	id	Daftar Backup
44	id	Daftar Terjemahan
45	id	Terjemahan yang Hilang
46	id	Bahasa
47	id	Log Aktivitas Pengguna
48	id	Daftar Pengguna
49	id	Aktivitas Pengguna
50	id	Simpan
51	id	Buat
52	id	Daftar
53	id	Dashboard
54	id	Laporan
55	id	Desimal Mata Uang
56	id	Desimal Jumlah
57	id	Tampilkan Logo Perusahaan
58	id	Konfigurasi telah berubah.
59	id	Sistem
60	id	Perusahaan
61	id	Laporan
62	id	Pengguna
63	id	Pengguna
64	id	ID
65	id	Username
66	id	Password
67	id	Email
68	id	Nama Lengkap
69	id	Telp. 1
70	id	Telp. 2
71	id	Alamat
72	id	Status
73	id	Login Terakhir
74	id	Active Key
75	id	Role
\.


--
-- Name: message_seq; Type: SEQUENCE SET; Schema: public; Owner: simpatdadb
--

SELECT pg_catalog.setval('message_seq', 76, true);


--
-- Data for Name: operation; Type: TABLE DATA; Schema: public; Owner: simpatdadb
--

COPY operation (id, name, description, nama_modul, grup, urutan_ke, tampilkan_dirole) FROM stdin;
1	accessLog.index	View Access Log List	AccessLog	1	1	1
2	site.config	Setting Site Config	Settings	1	1	1
3	operation.create	Create New Operation 	Operation	1	1	1
4	operation.update	Update Operation 	Operation	1	1	1
5	operation.delete	Delete Operation 	Operation	1	1	1
6	operation.admin	Manage All Operation	Operation	1	1	1
7	operation.generate	Generate Operation 	Operation	1	1	1
8	profile.profile	View Own Profile	Profile	1	1	1
9	profile.edit	Edit Own Profile 	Profile	1	1	1
11	role.view	View Role List	Role	1	1	1
12	role.create	Create New Role 	Role	1	1	1
13	role.update	Update Role 	Role	1	1	1
14	role.delete	Delete Role 	Role	1	1	1
15	role.ajaxRevoke	Revoke User Role Via Ajax	Role	1	1	1
16	role.index	View Role List	Role	1	1	1
17	role.admin	Manage All Role	Role	1	1	1
18	role.assign	Assign User Role 	Role	1	1	1
19	role.ajaxAssign	Assign User Role Via Ajax 	Role	1	1	1
20	user.view	View User 	User	2	1	1
21	user.create	Create New User 	User	2	1	1
22	user.update	Update User 	User	2	1	1
23	user.delete	Delete User 	User	2	1	1
24	user.index	View All User List	User	2	1	1
25	report.user	View User Log List Report	Report	1	1	1
26	operation.generateAll	Operation GenerateAll	Operation	1	1	1
27	profile.changePhoto	Profile ChangePhoto	Profile	1	1	1
28	report.userLog	Report UserLog	Report	1	1	1
29	report.userLogForm	Report UserLogForm	Report	1	1	1
30	backup.default.create	Backup Default Create	Backup	1	1	1
31	backup.default.delete	Backup Default Delete	Backup	1	1	1
32	backup.default.download	Backup Default Download	Backup	1	1	1
33	backup.default.index	Backup Default Index	Backup	1	1	1
34	backup.default.restore	Backup Default Restore	Backup	1	1	1
35	backup.default.upload	Backup Default Upload	Backup	1	1	1
36	translate.edit.create	Translate Edit Create	Translate	1	1	1
37	translate.edit.update	Translate Edit Update	Translate	1	1	1
38	translate.edit.delete	Translate Edit Delete	Translate	1	1	1
39	translate.edit.index	Translate Edit Index	Translate	1	1	1
40	translate.edit.missing	Translate Edit Missing	Translate	1	1	1
41	translate.edit.missingdelete	Translate Edit Missingdelete	Translate	1	1	1
42	translate.translate.index	Translate Translate Index	Translate	1	1	1
43	accessLog.download	AccessLog Download	AccessLog	1	1	1
44	site.index	Site Index	Site	1	1	1
45	jReport.userList	JReport UserList	JReport	1	1	1
46	jReport.userActivityList	JReport UserActivityList	JReport	1	1	1
49	bidangUsaha.create	BidangUsaha Create	BidangUsaha	2	1	1
50	bidangUsaha.update	BidangUsaha Update	BidangUsaha	2	1	1
51	bidangUsaha.delete	BidangUsaha Delete	BidangUsaha	2	1	1
52	bidangUsaha.index	BidangUsaha Index	BidangUsaha	2	1	1
54	golongan.create	Golongan Create	Golongan	2	1	1
55	golongan.update	Golongan Update	Golongan	2	1	1
56	golongan.delete	Golongan Delete	Golongan	2	1	1
59	jabatan.create	Jabatan Create	Jabatan	2	1	1
60	jabatan.update	Jabatan Update	Jabatan	2	1	1
61	jabatan.delete	Jabatan Delete	Jabatan	2	1	1
62	jabatan.index	Jabatan Index	Jabatan	2	1	1
63	jenisSurat.view	JenisSurat View	JenisSurat	2	1	1
64	jenisSurat.create	JenisSurat Create	JenisSurat	2	1	1
65	jenisSurat.update	JenisSurat Update	JenisSurat	2	1	1
66	jenisSurat.delete	JenisSurat Delete	JenisSurat	2	1	1
67	jenisSurat.index	JenisSurat Index	JenisSurat	2	1	1
69	kecamatan.create	Kecamatan Create	Kecamatan	2	1	1
70	kecamatan.update	Kecamatan Update	Kecamatan	2	1	1
71	kecamatan.delete	Kecamatan Delete	Kecamatan	2	1	1
72	kecamatan.index	Kecamatan Index	Kecamatan	2	1	1
74	kelurahan.create	Kelurahan Create	Kelurahan	2	1	1
75	kelurahan.update	Kelurahan Update	Kelurahan	2	1	1
76	kelurahan.delete	Kelurahan Delete	Kelurahan	2	1	1
77	kelurahan.index	Kelurahan Index	Kelurahan	2	1	1
79	kodeRekening.create	KodeRekening Create	KodeRekening	2	1	1
80	kodeRekening.update	KodeRekening Update	KodeRekening	2	1	1
81	kodeRekening.delete	KodeRekening Delete	KodeRekening	2	1	1
82	kodeRekening.index	KodeRekening Index	KodeRekening	2	1	1
84	pangkat.create	Pangkat Create	Pangkat	2	1	1
85	pangkat.update	Pangkat Update	Pangkat	2	1	1
86	pangkat.delete	Pangkat Delete	Pangkat	2	1	1
87	pangkat.index	Pangkat Index	Pangkat	2	1	1
88	pejabat.view	Pejabat View	Pejabat	2	1	1
89	pejabat.create	Pejabat Create	Pejabat	2	1	1
90	pejabat.update	Pejabat Update	Pejabat	2	1	1
91	pejabat.delete	Pejabat Delete	Pejabat	2	1	1
92	pejabat.index	Pejabat Index	Pejabat	2	1	1
94	wajibPajak.view	WajibPajak View	WajibPajak	2	1	1
95	wajibPajak.create	WajibPajak Create	WajibPajak	2	1	1
96	wajibPajak.update	WajibPajak Update	WajibPajak	2	1	1
10	profile.changePassword	Change Own Password	Profile	1	1	1
57	golongan.index	Golongan Index	Golongan	2	1	1
78	kodeRekening.view	KodeRekening View	KodeRekening	2	1	1
97	wajibPajak.delete	WajibPajak Delete	WajibPajak	2	1	1
98	wajibPajak.index	WajibPajak Index	WajibPajak	2	1	1
\.


--
-- Name: operation_seq; Type: SEQUENCE SET; Schema: public; Owner: simpatdadb
--

SELECT pg_catalog.setval('operation_seq', 98, true);


--
-- Data for Name: pangkat; Type: TABLE DATA; Schema: public; Owner: simpatdadb
--

COPY pangkat (id, nama, created, updated) FROM stdin;
\.


--
-- Name: pangkat_id_seq; Type: SEQUENCE SET; Schema: public; Owner: simpatdadb
--

SELECT pg_catalog.setval('pangkat_id_seq', 1, false);


--
-- Data for Name: pejabat; Type: TABLE DATA; Schema: public; Owner: simpatdadb
--

COPY pejabat (id, kode, nama, nip, status, created, updated, golongan_id, jabatan_id, pangkat_id) FROM stdin;
\.


--
-- Name: pejabat_id_seq; Type: SEQUENCE SET; Schema: public; Owner: simpatdadb
--

SELECT pg_catalog.setval('pejabat_id_seq', 1, false);


--
-- Data for Name: role; Type: TABLE DATA; Schema: public; Owner: simpatdadb
--

COPY role (id, name) FROM stdin;
1	Super User
\.


--
-- Data for Name: role_access; Type: TABLE DATA; Schema: public; Owner: simpatdadb
--

COPY role_access (role_id, operation_id) FROM stdin;
1	43
1	1
1	30
1	31
1	32
1	33
1	34
1	35
1	46
1	45
1	6
1	3
1	5
1	7
1	26
1	4
1	10
1	27
1	9
1	8
1	25
1	28
1	29
1	17
1	19
1	15
1	18
1	12
1	14
1	16
1	13
1	11
1	2
1	44
1	36
1	38
1	39
1	40
1	41
1	37
1	42
1	49
1	51
1	52
1	50
1	54
1	56
1	57
1	55
1	59
1	61
1	62
1	60
1	64
1	66
1	67
1	65
1	63
1	69
1	71
1	72
1	70
1	74
1	76
1	77
1	75
1	79
1	81
1	82
1	80
1	78
1	84
1	86
1	87
1	85
1	89
1	91
1	92
1	90
1	88
1	21
1	23
1	24
1	22
1	20
1	95
1	97
1	98
1	96
1	94
\.


--
-- Name: role_seq; Type: SEQUENCE SET; Schema: public; Owner: simpatdadb
--

SELECT pg_catalog.setval('role_seq', 1, false);


--
-- Data for Name: sourcemessage; Type: TABLE DATA; Schema: public; Owner: simpatdadb
--

COPY sourcemessage (id, category, message) FROM stdin;
1	trans	Config
2	trans	Settings
3	trans	Fields with
4	trans	are required.
5	trans	Sistem
6	trans	Page Title
7	trans	Admin Email
8	trans	Company Name
9	trans	Company Email
10	trans	Allow user registration?
11	trans	New User Default Role
12	trans	Company Name Report
13	trans	Company Description Report
14	trans	Company Address Report
15	trans	Language
16	trans	Default Page Size
17	trans	Perusahaan
18	trans	Company Address
19	trans	Laporan
20	trans	Save
21	trans	Application Name Title
22	trans	Administration
23	trans	Manage User
24	trans	Manage Role
25	trans	Manage Operation
26	trans	Manage Translation
27	trans	User Access Log
28	trans	Help
29	trans	Profile
30	trans	Edit Profile
31	trans	Change Password
32	trans	Login
33	trans	Logout ({user})
36	trans	User Log Report
37	trans	SIMPATDA
38	trans	Manage Backup DB
39	trans	Upload Photo
40	trans	Translate
41	trans	Tampil
42	trans	Operations
43	trans	List Backup
44	trans	List Messages
45	trans	Missing Translations
46	trans	Language
47	trans	User Log
48	trans	User List
49	trans	User Actvity
50	trans	Simpan
51	trans	Create
52	trans	Manage
53	trans	Dashboard
54	trans	Report
55	trans	Currency Precision
56	trans	Quantity Precision
57	trans	Display Company Logo
58	trans	Configuration has been changed.
59	trans	System
60	trans	Company
61	trans	Reports
62	trans	User
63	trans	Users
64	trans	ID
65	trans	Username
66	trans	Password
67	trans	Email
68	trans	Fullname
69	trans	Phone 1
70	trans	Phone 2
71	trans	Address
72	trans	Status
73	trans	Last Login
74	trans	Activkey
75	trans	Role
76	trans	Don't have an account?
77	trans	User Login.
78	trans	Please provide your details
79	trans	Remember me next time
80	trans	Forgot Password
81	trans	Error
82	trans	Sorry, an error has occured! Why not try going back to the <a href="{url}">home page</a> or perhaps try following!
83	trans	Back to Dashboard
89	trans	Home
90	trans	Access Log List
91	trans	Type
92	trans	Activity
93	trans	Time
95	trans	Roles
96	trans	Name
97	trans	Update
98	trans	View
99	trans	Master
100	trans	Update Role ID : 
101	trans	You do not have sufficient permissions to access this page.
102	trans	View Role ID : 
103	trans	Delete
104	trans	Assign User
105	trans	Revoke
106	trans	View Profile
107	trans	Change Photo
108	trans	Log Akses
109	trans	Download LOG
110	trans	Data Master
111	trans	Bidang Usaha
112	trans	Golongan
113	trans	Jabatan
114	trans	Jenis Surat
115	trans	Kecamatan
116	trans	Kelurahan
117	trans	Kode Rekening
118	trans	Pangkat
119	trans	Pejabat
120	trans	Wajib Pajak
121	trans	Generate All
122	trans	Description
123	trans	Nama Modul
124	trans	Grup
125	trans	Urutan Ke
126	trans	Tampilkan Dirole
127	trans	Generate
128	trans	Operation
129	trans	Update Operation ID : 
132	trans	Kode
133	trans	Nama
134	trans	Created
135	trans	Updated
130	trans	Manage Bidang Usaha
131	trans	Bidang Usaha
136	trans	Manage Jenis Surat
137	trans	Singkatan
138	trans	Is Official
139	trans	Is Self
140	trans	Delete Operation ID : 
141	trans	Create Bidang Usaha ID : 
142	trans	Update Bidang Usaha ID : 
143	trans	Delete Bidang Usaha ID : 
144	trans	Create Jenis Surat ID : 
145	trans	View Jenis Surat ID : {id}
146	trans	Are you sure you want to delete this item?
\.


--
-- Name: sourcemessage_seq; Type: SEQUENCE SET; Schema: public; Owner: simpatdadb
--

SELECT pg_catalog.setval('sourcemessage_seq', 146, true);


--
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: simpatdadb
--

COPY "user" (id, username, image, password, email, fullname, phone_1, phone_2, address, status, last_login, activkey, role_id) FROM stdin;
1	admin	eb775e4610fe263212b228cb1290253c8dbe66ac.jpg	d033e22ae348aeb5660fc2140aec35850c4da997	admin@taneweb.com	Administrator PG	081888888	\N	Jl. Jambu Klutuk	1	2015-11-17 20:37:56	\N	1
\.


--
-- Name: user_seq; Type: SEQUENCE SET; Schema: public; Owner: simpatdadb
--

SELECT pg_catalog.setval('user_seq', 2, true);


--
-- Data for Name: wajib_pajak; Type: TABLE DATA; Schema: public; Owner: simpatdadb
--

COPY wajib_pajak (id, jenis, golongan, nomor, nama, alamat, kabupaten, kecamatan, kelurahan, telepon, status, tanggal_tutup, kodepos, id_jenis, id_nomor, tanggal_lahir, kk_nomor, kk_tanggal, pekerjaan, alamat_pekerjaan, bu_nama, bu_alamat, bu_kabupaten, bu_kecamatan, bu_kelurahan, bu_telepon, bu_kodepos, kelurahan_id, kecamatan_id, bidang_usaha_id, warga_negara, created, updated) FROM stdin;
\.


--
-- Name: wajib_pajak_id_seq; Type: SEQUENCE SET; Schema: public; Owner: simpatdadb
--

SELECT pg_catalog.setval('wajib_pajak_id_seq', 1, false);


--
-- Name: access_log_pkey; Type: CONSTRAINT; Schema: public; Owner: simpatdadb; Tablespace: 
--

ALTER TABLE ONLY access_log
    ADD CONSTRAINT access_log_pkey PRIMARY KEY (id);


--
-- Name: bidang_usaha_PK; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY bidang_usaha
    ADD CONSTRAINT "bidang_usaha_PK" PRIMARY KEY (id);


--
-- Name: golongan_PK; Type: CONSTRAINT; Schema: public; Owner: simpatdadb; Tablespace: 
--

ALTER TABLE ONLY golongan
    ADD CONSTRAINT "golongan_PK" PRIMARY KEY (id);


--
-- Name: jabatan_PK; Type: CONSTRAINT; Schema: public; Owner: simpatdadb; Tablespace: 
--

ALTER TABLE ONLY jabatan
    ADD CONSTRAINT "jabatan_PK" PRIMARY KEY (id);


--
-- Name: jenis_surat_PK; Type: CONSTRAINT; Schema: public; Owner: simpatdadb; Tablespace: 
--

ALTER TABLE ONLY jenis_surat
    ADD CONSTRAINT "jenis_surat_PK" PRIMARY KEY (id);


--
-- Name: kecamatan_PK; Type: CONSTRAINT; Schema: public; Owner: simpatdadb; Tablespace: 
--

ALTER TABLE ONLY kecamatan
    ADD CONSTRAINT "kecamatan_PK" PRIMARY KEY (id);


--
-- Name: kelurahan_PK; Type: CONSTRAINT; Schema: public; Owner: simpatdadb; Tablespace: 
--

ALTER TABLE ONLY kelurahan
    ADD CONSTRAINT "kelurahan_PK" PRIMARY KEY (id);


--
-- Name: kode_rekening_PK; Type: CONSTRAINT; Schema: public; Owner: simpatdadb; Tablespace: 
--

ALTER TABLE ONLY kode_rekening
    ADD CONSTRAINT "kode_rekening_PK" PRIMARY KEY (id);


--
-- Name: message_pkey; Type: CONSTRAINT; Schema: public; Owner: simpatdadb; Tablespace: 
--

ALTER TABLE ONLY message
    ADD CONSTRAINT message_pkey PRIMARY KEY (id);


--
-- Name: operation_pkey; Type: CONSTRAINT; Schema: public; Owner: simpatdadb; Tablespace: 
--

ALTER TABLE ONLY operation
    ADD CONSTRAINT operation_pkey PRIMARY KEY (id);


--
-- Name: pangkat_PK; Type: CONSTRAINT; Schema: public; Owner: simpatdadb; Tablespace: 
--

ALTER TABLE ONLY pangkat
    ADD CONSTRAINT "pangkat_PK" PRIMARY KEY (id);


--
-- Name: pejabat_PK; Type: CONSTRAINT; Schema: public; Owner: simpatdadb; Tablespace: 
--

ALTER TABLE ONLY pejabat
    ADD CONSTRAINT "pejabat_PK" PRIMARY KEY (id);


--
-- Name: role_pkey; Type: CONSTRAINT; Schema: public; Owner: simpatdadb; Tablespace: 
--

ALTER TABLE ONLY role
    ADD CONSTRAINT role_pkey PRIMARY KEY (id);


--
-- Name: sourcemessage_pkey; Type: CONSTRAINT; Schema: public; Owner: simpatdadb; Tablespace: 
--

ALTER TABLE ONLY sourcemessage
    ADD CONSTRAINT sourcemessage_pkey PRIMARY KEY (id);


--
-- Name: user_pkey; Type: CONSTRAINT; Schema: public; Owner: simpatdadb; Tablespace: 
--

ALTER TABLE ONLY "user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);


--
-- Name: wajib_pajak_PK; Type: CONSTRAINT; Schema: public; Owner: simpatdadb; Tablespace: 
--

ALTER TABLE ONLY wajib_pajak
    ADD CONSTRAINT "wajib_pajak_PK" PRIMARY KEY (id);


--
-- Name: access_log_fk_user; Type: FK CONSTRAINT; Schema: public; Owner: simpatdadb
--

ALTER TABLE ONLY access_log
    ADD CONSTRAINT access_log_fk_user FOREIGN KEY (user_id) REFERENCES "user"(id) ON DELETE CASCADE;


--
-- Name: kelurahan_FK_1; Type: FK CONSTRAINT; Schema: public; Owner: simpatdadb
--

ALTER TABLE ONLY kelurahan
    ADD CONSTRAINT "kelurahan_FK_1" FOREIGN KEY (kecamatan_id) REFERENCES kecamatan(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: kode_rekening_FK_1; Type: FK CONSTRAINT; Schema: public; Owner: simpatdadb
--

ALTER TABLE ONLY kode_rekening
    ADD CONSTRAINT "kode_rekening_FK_1" FOREIGN KEY (parent_id) REFERENCES kode_rekening(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: message_fk_sourcemessage; Type: FK CONSTRAINT; Schema: public; Owner: simpatdadb
--

ALTER TABLE ONLY message
    ADD CONSTRAINT message_fk_sourcemessage FOREIGN KEY (id) REFERENCES sourcemessage(id) ON DELETE CASCADE;


--
-- Name: pejabat_FK_1; Type: FK CONSTRAINT; Schema: public; Owner: simpatdadb
--

ALTER TABLE ONLY pejabat
    ADD CONSTRAINT "pejabat_FK_1" FOREIGN KEY (jabatan_id) REFERENCES jabatan(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: pejabat_FK_2; Type: FK CONSTRAINT; Schema: public; Owner: simpatdadb
--

ALTER TABLE ONLY pejabat
    ADD CONSTRAINT "pejabat_FK_2" FOREIGN KEY (golongan_id) REFERENCES golongan(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: pejabat_FK_3; Type: FK CONSTRAINT; Schema: public; Owner: simpatdadb
--

ALTER TABLE ONLY pejabat
    ADD CONSTRAINT "pejabat_FK_3" FOREIGN KEY (pangkat_id) REFERENCES pangkat(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: role_access_fk_operation; Type: FK CONSTRAINT; Schema: public; Owner: simpatdadb
--

ALTER TABLE ONLY role_access
    ADD CONSTRAINT role_access_fk_operation FOREIGN KEY (operation_id) REFERENCES operation(id);


--
-- Name: role_access_fk_role; Type: FK CONSTRAINT; Schema: public; Owner: simpatdadb
--

ALTER TABLE ONLY role_access
    ADD CONSTRAINT role_access_fk_role FOREIGN KEY (role_id) REFERENCES role(id);


--
-- Name: user_fk_role; Type: FK CONSTRAINT; Schema: public; Owner: simpatdadb
--

ALTER TABLE ONLY "user"
    ADD CONSTRAINT user_fk_role FOREIGN KEY (role_id) REFERENCES role(id);


--
-- Name: wajib_pajak_FK_1; Type: FK CONSTRAINT; Schema: public; Owner: simpatdadb
--

ALTER TABLE ONLY wajib_pajak
    ADD CONSTRAINT "wajib_pajak_FK_1" FOREIGN KEY (kecamatan_id) REFERENCES kecamatan(id) ON UPDATE SET NULL ON DELETE SET NULL;


--
-- Name: wajib_pajak_FK_2; Type: FK CONSTRAINT; Schema: public; Owner: simpatdadb
--

ALTER TABLE ONLY wajib_pajak
    ADD CONSTRAINT "wajib_pajak_FK_2" FOREIGN KEY (kelurahan_id) REFERENCES kelurahan(id) ON UPDATE SET NULL ON DELETE SET NULL;


--
-- Name: wajib_pajak_FK_3; Type: FK CONSTRAINT; Schema: public; Owner: simpatdadb
--

ALTER TABLE ONLY wajib_pajak
    ADD CONSTRAINT "wajib_pajak_FK_3" FOREIGN KEY (bidang_usaha_id) REFERENCES bidang_usaha(id) ON UPDATE SET NULL ON DELETE SET NULL;


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

